<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LotteryTemplatesModel;


class Dashboard extends BaseController
{

    protected $templateModel;

    public function __construct()
    {
        $this->templateModel = new LotteryTemplatesModel();
    }

    public function index()
    {
        // Only logged-in users can access
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user(); // Get current logged-in user

        // return view('pages/admin-dashboard');
        return view('pages/admin-dashboard', ['user' => $user]);
    }

    function admin_dashboard() {
        // Only logged-in users can access
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        $db = \Config\Database::connect();
        $user = auth()->user(); // Get current logged-in user
        date_default_timezone_set('Asia/Kolkata'); // Set timezone to IST

        $currentDate = date('Y-m-d');
        
        $results = $db->table('lottery_results')
            ->where('draw_date', $currentDate)
            ->get()
            ->getResult();

        $resultArray = [
            '1pm-result' => null,
            '8pm-result' => null
        ];

        // Populate resultArray based on draw_time
        foreach ($results as $result) {
            if ($result->draw_time == '13:00:00') {
                $resultArray['1pm-result'] = $result;
            } elseif ($result->draw_time == '20:00:00') {
                $resultArray['8pm-result'] = $result;
            }
        }

        $allResultData = $this->getAllLotteryResults();

        $passToView = [
            'title'=> 'Admin Dashboard',
            'resultArray' => $resultArray,
            'lotteryResults' => $allResultData,
            'counterData' => $this->getPublishedCountsByTime($allResultData),
        ];

        return view('templates/header-main', $passToView)
        . view('pages/admin-dashboard', ['user' => $user])
        . view('templates/footer-main');
    }
   function add_result($resultId = 0) {
        // Only logged-in users can access
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user(); // Get current logged-in user

        // Determine if this is add or edit mode
        $isEditMode = $resultId > 0;
        
        // Prepare data for view
        $passToView = [
            'title' => $isEditMode ? 'Edit Result' : 'Add Result',
            'isEditMode' => $isEditMode,
            'resultId' => $resultId
        ];

        // If edit mode, you might want to validate that the result exists
        if ($isEditMode) {
            $db = \Config\Database::connect();
            $result = $db->table('lottery_results')->where('id', $resultId)->get()->getRow();
            
            if (!$result) {
                // Result not found, redirect or show error
                return redirect()->back()->with('error', 'Lottery result not found');
            }
            
            $passToView['result'] = $result;
        }

        return view('templates/header-main', $passToView)
            . view('pages/add-result', [
                'user' => $user,
                'isEditMode' => $isEditMode,
                'resultId' => $resultId
            ])
            . view('templates/footer-main');
    }

    // Print out layout function
    public function lottery_print() {
         // Only logged-in users can access
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        return view('lottery_templates/lottery-paper-print');
    }

    public function add_lottery() {
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        
        $passToView = ['title' => 'Create Lottery'];

        return view('templates/header-main', $passToView)
            . view('pages/add-lottery')
            . view('templates/footer-main');
    }

    public function edit_result($resultId) {
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        $db = \Config\Database::connect();
        $result = $db->table('lottery_results')->where('id', $resultId)->get()->getRow();
            
        if (!$result) {
            // Result not found, redirect or show error
            return redirect()->back()->with('error', 'Lottery result not found');
        }

        $passToView = ['title' => 'Edit Lottery'];        
        $lotteryData = $this->getResultWithPrizes($resultId);
        if(empty($lotteryData)) {
            return redirect('admin/admin-dashboard');
        }

         return view('templates/header-main', $passToView)
        . view('pages/edit-result', [
            'resultId'     => $resultId,
            'lottery_data' => $lotteryData
        ])
            . view('templates/footer-main');       

    }

    /**
     * Get all lottery result data (without prize details)
     * 
     * @return array
     */
    public function getAllLotteryResults()
    {
        try {
            $db = \Config\Database::connect();

            // Fetch all lottery results
            $results = $db->table('lottery_results')
              ->orderBy('id', 'DESC')
              ->get()
              ->getResult();


            if (empty($results)) {
                return []; // Simply return an empty array if no results
            }

            $resultData = [];

            foreach ($results as $result) {
                $resultData[] = [
                    'result_id'       => $result->id,
                    'status'          => $result->status,
                    'draw_date_short' => date('d/m/y', strtotime($result->draw_date)),
                    'draw_date_full'  => date('d/m/Y', strtotime($result->draw_date)),
                    'draw_time'       => date('g A', strtotime($result->draw_time)),
                ];
            }

            return $resultData;

        } catch (\Exception $e) {
            log_message('error', 'Error fetching lottery results: ' . $e->getMessage());
            return []; // Return empty array on error as well
        }
    }

    /**
     * Get counts of published results at 1 PM and 8 PM
     *
     * @param array $results
     * @return array
     */
    function getPublishedCountsByTime(array $results): array
    {
        $counts = [
            '1pm' => 0,
            '8pm' => 0
        ];

        foreach ($results as $result) {
            if (isset($result['status'], $result['draw_time']) && strtolower($result['status']) === 'published') {
                $time = strtolower(trim($result['draw_time']));

                if ($time === '1 pm') {
                    $counts['1pm']++;
                } elseif ($time === '8 pm') {
                    $counts['8pm']++;
                }
            }
        }

        return $counts;
    }

    /**
     * Get organized prizes for a given result ID
     *
     * @param int $resultId
     * @return array
     */
    public function getOrganizedPrizesByResultId(int $resultId): array
    {
        $db = \Config\Database::connect();

        $prizes = $db->table('lottery_prizes')
                    ->where('result_id', $resultId)
                    ->orderBy('prize_level', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->get()
                    ->getResult();

        // Initialize prize sections
        $organizedPrizes = [
            'section1' => [], // 1st
            'section2' => [], // 2nd
            'section3' => [], // 3rd
            'section4' => [], // 4th
            'section5' => []  // 5th
        ];

        foreach ($prizes as $prize) {
            switch (strtolower($prize->prize_level)) {
                case '1st':
                    $organizedPrizes['section1'][] = $prize->prize_number;
                    break;
                case '2nd':
                    $organizedPrizes['section2'][] = $prize->prize_number;
                    break;
                case '3rd':
                    $organizedPrizes['section3'][] = $prize->prize_number;
                    break;
                case '4th':
                    $organizedPrizes['section4'][] = $prize->prize_number;
                    break;
                case '5th':
                    $organizedPrizes['section5'][] = $prize->prize_number;
                    break;
            }
        }

        return $organizedPrizes;
    }

    /**
     * Get result row and organized prizes by result ID
     *
     * @param int $resultId
     * @return array|null
     */
    function getResultWithPrizes(int $resultId): ?array
    {
        $db = \Config\Database::connect();

        // Get the result row
        $result = $db->table('lottery_results')
                    ->where('id', $resultId)
                    ->get()
                    ->getRow();

        if (!$result) {
            return null; // No result found
        }

        // Get all associated prizes
        $prizes = $db->table('lottery_prizes')
                    ->where('result_id', $resultId)
                    ->orderBy('prize_level', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->get()
                    ->getResult();

        // Organize prizes into sections
        $organizedPrizes = [
            'section1' => [],
            'section2' => [],
            'section3' => [],
            'section4' => [],
            'section5' => [],
        ];

        foreach ($prizes as $prize) {
            switch (strtolower($prize->prize_level)) {
                case '1st':
                    $organizedPrizes['section1'][] = ['id'=>$prize->id, 'number'=>$prize->prize_number];
                    break;
                case '2nd':
                    $organizedPrizes['section2'][] = ['id'=>$prize->id, 'number'=>$prize->prize_number];
                    break;
                case '3rd':
                    $organizedPrizes['section3'][] = ['id'=>$prize->id, 'number'=>$prize->prize_number];
                    break;
                case '4th':
                    $organizedPrizes['section4'][] = ['id'=>$prize->id, 'number'=>$prize->prize_number];
                    break;
                case '5th':
                    $organizedPrizes['section5'][] = ['id'=>$prize->id, 'number'=>$prize->prize_number];
                    break;
            }
        }

        // Return combined data
        return [
            'result_id'      => $result->id,
            'draw_date'      => $result->draw_date,
            'draw_time'      =>  date('g A', strtotime($result->draw_time)),
            'status'         => $result->status,
            'lottery_data'   => $organizedPrizes,
        ];
    }

    /*
     * Updates Prize Number
    */
    public function updatePrizeSeries()
    {
        // Only logged-in users can access
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        $request = $this->request->getJSON(true);
        $updates = $request['updates'] ?? [];

        if (empty($updates)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No updates received.'
            ])->setStatusCode(400);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('lottery_prizes');

        foreach ($updates as $row) {
            $builder->where('id', $row['prize_id'])
                    ->update(['prize_number' => $row['prize_number']]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Prizes updated successfully.'
        ]);
    }


}