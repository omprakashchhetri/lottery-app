<?php

namespace App\Models;

use CodeIgniter\Model;

class LotteryTemplatesModel extends Model
{
    protected $table = 'lottery_templates';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'templatefile',
        'preview_image',
        'first_prize_count',
        'second_prize_count',
        'third_prize_count',
        'fourth_prize_count',
        'fifth_prize_count',
        'type',
        'is_active',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'templatefile' => 'required|max_length[255]',
        'preview_image' => 'permit_empty|max_length[255]',
        'first_prize_count' => 'required|is_natural_no_zero',
        'second_prize_count' => 'required|is_natural_no_zero',
        'third_prize_count' => 'required|is_natural_no_zero',
        'fourth_prize_count' => 'required|is_natural_no_zero',
        'fifth_prize_count' => 'required|is_natural_no_zero',
        'type' => 'required|in_list[daily,weekly,monthly,special]',
        'is_active' => 'required|in_list[0,1]'
    ];

    protected $validationMessages = [
        'templatefile' => [
            'required' => 'Template file is required.',
            'max_length' => 'Template file name cannot exceed 255 characters.'
        ],
        'type' => [
            'required' => 'Lottery type is required.',
            'in_list' => 'Lottery type must be one of: daily, weekly, monthly, special.'
        ],
        'first_prize_count' => [
            'required' => 'First prize count is required.',
            'is_natural_no_zero' => 'First prize count must be a positive number.'
        ],
        'second_prize_count' => [
            'required' => 'Second prize count is required.',
            'is_natural_no_zero' => 'Second prize count must be a positive number.'
        ],
        'third_prize_count' => [
            'required' => 'Third prize count is required.',
            'is_natural_no_zero' => 'Third prize count must be a positive number.'
        ],
        'fourth_prize_count' => [
            'required' => 'Fourth prize count is required.',
            'is_natural_no_zero' => 'Fourth prize count must be a positive number.'
        ],
        'fifth_prize_count' => [
            'required' => 'Fifth prize count is required.',
            'is_natural_no_zero' => 'Fifth prize count must be a positive number.'
        ],
        'is_active' => [
            'required' => 'Active status is required.',
            'in_list' => 'Active status must be 0 or 1.'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setDefaults'];
    protected $beforeUpdate = ['validateTemplateFile'];

    // Custom Methods

    /**
     * Get all active lottery templates
     */
    public function getActiveTemplates()
    {
        return $this->where('is_active', 1)->findAll();
    }

    /**
     * Get templates by type
     */
    public function getTemplatesByType($type)
    {
        return $this->where('type', $type)->findAll();
    }

    /**
     * Get active templates by type
     */
    public function getActiveTemplatesByType($type)
    {
        return $this->where('type', $type)
                    ->where('is_active', 1)
                    ->findAll();
    }

    /**
     * Get template with total prize count
     */
    public function getTemplateWithTotalPrizes($id)
    {
        $template = $this->find($id);
        
        if ($template) {
            $template['total_prizes'] = $template['first_prize_count'] + 
                                      $template['second_prize_count'] + 
                                      $template['third_prize_count'] + 
                                      $template['fourth_prize_count'] + 
                                      $template['fifth_prize_count'];
        }
        
        return $template;
    }

    /**
     * Get all templates with total prize counts
     */
    public function getTemplatesWithTotalPrizes()
    {
        $templates = $this->findAll();
        
        foreach ($templates as &$template) {
            $template['total_prizes'] = $template['first_prize_count'] + 
                                      $template['second_prize_count'] + 
                                      $template['third_prize_count'] + 
                                      $template['fourth_prize_count'] + 
                                      $template['fifth_prize_count'];
        }
        
        return $templates;
    }

    /**
     * Toggle template active status
     */
    public function toggleActiveStatus($id)
    {
        $template = $this->find($id);
        
        if ($template) {
            $newStatus = $template['is_active'] == 1 ? 0 : 1;
            return $this->update($id, ['is_active' => $newStatus]);
        }
        
        return false;
    }

    /**
     * Get template statistics
     */
    public function getTemplateStats()
    {
        return [
            'total_templates' => $this->countAll(),
            'active_templates' => $this->where('is_active', 1)->countAllResults(),
            'inactive_templates' => $this->where('is_active', 0)->countAllResults(),
            'by_type' => $this->select('type, COUNT(*) as count')
                              ->groupBy('type')
                              ->findAll()
        ];
    }

    /**
     * Search templates
     */
    public function searchTemplates($keyword, $type = null, $activeOnly = false)
    {
        $builder = $this->builder();
        
        if ($keyword) {
            $builder->like('templatefile', $keyword);
        }
        
        if ($type) {
            $builder->where('type', $type);
        }
        
        if ($activeOnly) {
            $builder->where('is_active', 1);
        }
        
        return $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
    }


    /**
     * Get prize distribution for a template
     */
    public function getPrizeDistribution($id)
    {
        $template = $this->find($id);
        
        if (!$template) {
            return null;
        }
        
        $totalPrizes = $template['first_prize_count'] + 
                      $template['second_prize_count'] + 
                      $template['third_prize_count'] + 
                      $template['fourth_prize_count'] + 
                      $template['fifth_prize_count'];
        
        return [
            'first_prize' => [
                'count' => $template['first_prize_count'],
                'percentage' => ($template['first_prize_count'] / $totalPrizes) * 100
            ],
            'second_prize' => [
                'count' => $template['second_prize_count'],
                'percentage' => ($template['second_prize_count'] / $totalPrizes) * 100
            ],
            'third_prize' => [
                'count' => $template['third_prize_count'],
                'percentage' => ($template['third_prize_count'] / $totalPrizes) * 100
            ],
            'fourth_prize' => [
                'count' => $template['fourth_prize_count'],
                'percentage' => ($template['fourth_prize_count'] / $totalPrizes) * 100
            ],
            'fifth_prize' => [
                'count' => $template['fifth_prize_count'],
                'percentage' => ($template['fifth_prize_count'] / $totalPrizes) * 100
            ],
            'total_prizes' => $totalPrizes
        ];
    }

    /**
     * Duplicate a template
     */
    public function duplicateTemplate($id, $newTemplateName = null)
    {
        $template = $this->find($id);
        
        if (!$template) {
            return false;
        }
        
        // Remove id and timestamps
        unset($template['id']);
        unset($template['created_at']);
        unset($template['updated_at']);
        
        // Set new template name if provided
        if ($newTemplateName) {
            $template['templatefile'] = $newTemplateName;
        } else {
            $template['templatefile'] = 'copy_of_' . $template['templatefile'];
        }
        
        // Set as inactive by default
        $template['is_active'] = 0;
        
        return $this->insert($template);
    }

    // Callback Methods

    /**
     * Set default values before insert
     */
    protected function setDefaults(array $data)
    {
        // Set default active status if not provided
        if (!isset($data['data']['is_active'])) {
            $data['data']['is_active'] = 1;
        }
        
        return $data;
    }

    /**
     * Validate template file exists before update
     */
    protected function validateTemplateFile(array $data)
    {
        if (isset($data['data']['templatefile'])) {
            $templatePath = APPPATH . 'Views/lottery_templates/' . $data['data']['templatefile'];
            
            if (!file_exists($templatePath)) {
                log_message('warning', 'Template file does not exist: ' . $templatePath);
            }
        }
        
        return $data;
    }

    // Static helper methods

    /**
     * Get available lottery types
     */
    public static function getLotteryTypes()
    {
        return [
            'daily' => 'Daily Lottery',
            'weekly' => 'Weekly Lottery',
            'monthly' => 'Monthly Lottery',
            'special' => 'Special Lottery'
        ];
    }

    /**
     * Get prize levels
     */
    public static function getPrizeLevels()
    {
        return [
            'first_prize_count' => 'First Prize',
            'second_prize_count' => 'Second Prize',
            'third_prize_count' => 'Third Prize',
            'fourth_prize_count' => 'Fourth Prize',
            'fifth_prize_count' => 'Fifth Prize'
        ];
    }
}