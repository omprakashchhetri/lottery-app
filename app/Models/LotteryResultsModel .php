<?php

namespace App\Models;

use CodeIgniter\Model;

class LotteryResultsModel extends Model
{
    protected $table = 'lottery_results';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    
    protected $allowedFields = [
        'template_id',
        'draw_date',
        'draw_time',
        'status',
        'pdf_path',
        'pdf_generated_at',
        'publish_time',
        'created_by',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'template_id' => 'required|is_natural_no_zero',
        'draw_date' => 'required|valid_date[Y-m-d]',
        'draw_time' => 'required|regex_match[/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/]',
        'status' => 'required|in_list[scheduled,draft,published,archive]',
        'pdf_path' => 'permit_empty|string|max_length[255]',
        'pdf_generated_at' => 'permit_empty|valid_date',
        'publish_time' => 'permit_empty|valid_date',
        'created_by' => 'permit_empty|is_natural_no_zero'
    ];

    protected $validationMessages = [
        'template_id' => [
            'required' => 'Template ID is required',
            'is_natural_no_zero' => 'Template ID must be a valid positive number'
        ],
        'draw_date' => [
            'required' => 'Draw date is required',
            'valid_date' => 'Draw date must be a valid date in Y-m-d format'
        ],
        'draw_time' => [
            'required' => 'Draw time is required',
            'regex_match' => 'Draw time must be in HH:MM:SS format'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be one of: scheduled, active, completed, cancelled'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get lottery results by status
     */
    public function getByStatus($status)
    {
        return $this->where('status', $status)->findAll();
    }

    /**
     * Get lottery results by template ID
     */
    public function getByTemplateId($templateId)
    {
        return $this->where('template_id', $templateId)->findAll();
    }

    /**
     * Get lottery results by date range
     */
    public function getByDateRange($startDate, $endDate)
    {
        return $this->where('draw_date >=', $startDate)
                   ->where('draw_date <=', $endDate)
                   ->findAll();
    }

    /**
     * Get scheduled lottery results
     */
    public function getScheduled()
    {
        return $this->where('status', 'scheduled')->findAll();
    }

    /**
     * Get active lottery results
     */
    public function getActive()
    {
        return $this->where('status', 'active')->findAll();
    }

    /**
     * Get completed lottery results
     */
    public function getCompleted()
    {
        return $this->where('status', 'completed')->findAll();
    }

    /**
     * Update lottery result status
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Update PDF path and generated timestamp
     */
    public function updatePdfInfo($id, $pdfPath)
    {
        return $this->update($id, [
            'pdf_path' => $pdfPath,
            'pdf_generated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get lottery results with pagination
     */
    public function getPaginated($perPage = 10, $page = 1)
    {
        return $this->paginate($perPage, 'default', $page);
    }

    /**
     * Get lottery results by creator
     */
    public function getByCreator($createdBy)
    {
        return $this->where('created_by', $createdBy)->findAll();
    }

    /**
     * Get today's lottery results
     */
    public function getTodaysResults()
    {
        return $this->where('draw_date', date('Y-m-d'))->findAll();
    }

    /**
     * Get upcoming lottery results
     */
    public function getUpcoming()
    {
        return $this->where('draw_date >=', date('Y-m-d'))
                   ->where('status', 'scheduled')
                   ->orderBy('draw_date', 'ASC')
                   ->orderBy('draw_time', 'ASC')
                   ->findAll();
    }

    /**
     * Check if PDF exists for a result
     */
    public function hasPdf($id)
    {
        $result = $this->find($id);
        return $result && !empty($result['pdf_path']);
    }

    /**
     * Get results that need PDF generation
     */
    public function getNeedingPdfGeneration()
    {
        return $this->where('status', 'completed')
                   ->where('pdf_path IS NULL')
                   ->findAll();
    }

    /**
     * Mark result as published
     */
    public function markAsPublished($id)
    {
        return $this->update($id, [
            'publish_time' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get published results
     */
    public function getPublished()
    {
        return $this->where('publish_time IS NOT NULL')->findAll();
    }
}