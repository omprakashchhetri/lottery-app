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

        $passToView = [
            'title'=> 'Admin Dashboard',
            'resultArray' => $resultArray,            
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
}