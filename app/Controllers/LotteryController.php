<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LotteryController extends BaseController
{
    /**
     * Save lottery results - simplified version
     * 
     * @return \CodeIgniter\HTTP\Response
     */
    public function saveLotteryResults()
    {
        try {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            
            // Get POST data
            $lotteryData = $request->getPost('lottery_data');
            $drawTime = $request->getPost('draw_time');
            $drawDate = $request->getPost('draw_date');
            
            // Basic validation - check if required fields exist
            if (!$lotteryData || !$drawTime || !$drawDate) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Missing required fields: lottery_data, draw_time, draw_date'
                ])->setStatusCode(400);
            }
            
            // Convert date format: "15th July 2025" -> "2025-07-15"
            $processedDate = $this->convertDate($drawDate);
            
            // Convert time format: "1 PM Result" -> "13:00:00"
            $processedTime = $this->convertTime($drawTime);
            
            // Prepare data for database
            $data = [
                'lottery_data' => json_encode($lotteryData),
                'draw_date' => $processedDate,
                'draw_time' => $processedTime,
                'status' => 'completed',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // Insert directly into database
            $result = $db->table('lottery_results')->insert($data);
            
            if ($result) {
                $insertId = $db->insertID();
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Lottery results saved successfully',
                    'data' => [
                        'id' => $insertId,
                        'draw_date' => $processedDate,
                        'draw_time' => $processedTime
                    ]
                ])->setStatusCode(201);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to save lottery results'
                ])->setStatusCode(500);
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Error saving lottery results: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error occurred'
            ])->setStatusCode(500);
        }
    }
    
    /**
     * Convert date string to Y-m-d format
     * 
     * @param string $dateString
     * @return string
     */
    private function convertDate($dateString)
    {
        try {
            // Remove ordinal suffixes (st, nd, rd, th)
            $cleanDate = preg_replace('/(\d+)(st|nd|rd|th)/', '$1', $dateString);
            $date = \DateTime::createFromFormat('j F Y', $cleanDate);
            
            if ($date) {
                return $date->format('Y-m-d');
            }
        } catch (\Exception $e) {
            log_message('error', 'Date conversion error: ' . $e->getMessage());
        }
        
        // Fallback to current date if conversion fails
        return date('Y-m-d');
    }
    
    /**
     * Convert time string to H:i:s format
     * 
     * @param string $timeString
     * @return string
     */
    private function convertTime($timeString)
    {
        try {
            // Remove "Result" text and clean up
            $cleanTime = preg_replace('/\s*Result\s*$/i', '', trim($timeString));
            $time = \DateTime::createFromFormat('g A', $cleanTime);
            
            if ($time) {
                return $time->format('H:i:s');
            }
        } catch (\Exception $e) {
            log_message('error', 'Time conversion error: ' . $e->getMessage());
        }
        
        // Fallback to current time if conversion fails
        return date('H:i:s');
    }
    
    /**
     * Get lottery results by ID
     * 
     * @param int $id
     * @return \CodeIgniter\HTTP\Response
     */
    public function getLotteryResults($id = null)
    {
        try {
            $db = \Config\Database::connect();
            
            if ($id === null) {
                // Get all results
                $results = $db->table('lottery_results')
                            ->orderBy('created_at', 'DESC')
                            ->limit(50)
                            ->get()
                            ->getResultArray();
                            
                // Decode lottery_data JSON for each result
                foreach ($results as &$result) {
                    if (isset($result['lottery_data'])) {
                        $result['lottery_data'] = json_decode($result['lottery_data'], true);
                    }
                }
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'data' => $results
                ]);
            }
            
            // Get specific result
            $result = $db->table('lottery_results')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
            
            if (!$result) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Lottery result not found'
                ])->setStatusCode(404);
            }
            
            // Decode lottery_data JSON
            if (isset($result['lottery_data'])) {
                $result['lottery_data'] = json_decode($result['lottery_data'], true);
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error fetching lottery results: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error occurred'
            ])->setStatusCode(500);
        }
    }
}