<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Transaction extends BaseController
{

    protected $templateModel;

    public function create_transaction()
    {
        return view('transaction_layouts/transaction-print');
    }
}