<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Index Page
    public function index()
    {
        $passToView['title'] = 'Meghalaya State Lotteries';
        return view('templates/header', $passToView)
            . view('pages/index')
            . view('templates/footer');
    }   
    
    // Old Result Page
    public function old_results()
    {
        $passToView['title'] = 'Old Results - Meghalaya State Lotteries';
        return view('templates/header', $passToView)
            . view('pages/old-result')
            . view('templates/footer');
    }
}