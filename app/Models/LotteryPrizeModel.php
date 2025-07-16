<?php

namespace App\Models;

use CodeIgniter\Model;

class LotteryPrizeModel extends Model
{
    protected $table = 'lottery_prizes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'result_id',
        'prize_level',
        'prize_number',
        'is_consolation',
        'remarks'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $validationRules = [
        'result_id' => 'required|integer',
        'prize_level' => 'required|max_length[50]',
        'prize_number' => 'required|max_length[50]',
        'is_consolation' => 'required|in_list[0,1]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}