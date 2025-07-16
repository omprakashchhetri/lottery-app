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

        $user = auth()->user(); // Get current logged-in user

        $data = [
            'templates' => $this->templateModel->getTemplatesWithTotalPrizes(),
            'stats' => $this->templateModel->getTemplateStats(),
            'lottery_types' => LotteryTemplatesModel::getLotteryTypes()
        ];

        $passToView = [
            'title'=> 'Admin Dashboard',
            'lottery_data' => $data,

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