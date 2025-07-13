<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
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

        $passToView = ['title'=> 'Admin Dashboard'];

        return view('templates/header-main', $passToView)
        . view('pages/admin-dashboard', ['user' => $user])
        . view('templates/footer-main');
        
    }
    function add_result() {
        // Only logged-in users can access
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user(); // Get current logged-in user

        $passToView = ['title'=> 'Add Result'];

        return view('templates/header-main', $passToView)
        . view('pages/add-result', ['user' => $user])
        . view('templates/footer-main');
    }

     public function customLogout()
    {
        // Get the auth service
        $auth = service('auth');
        
        // Logout the user
        $auth->logout();
        
        // Redirect to login page or home
        return redirect()->to('/login')->with('message', 'You have been logged out successfully.');
    }

}