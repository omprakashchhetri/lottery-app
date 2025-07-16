<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LotteryController extends BaseController
{
    /**
     * Get lottery result data for editing
     * 
     * @param int $resultId
     * @return \CodeIgniter\HTTP\Response
     */
    public function getLotteryResult($resultId)
    {
        try {
            $db = \Config\Database::connect();
            
            // Get main lottery result
            $result = $db->table('lottery_results')->where('id', $resultId)->get()->getRow();
            
            if (!$result) {
                return [];
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Lottery result not found'
                ])->setStatusCode(404);
            }
            
            // Get all prizes for this result
            $prizes = $db->table('lottery_prizes')
                        ->where('result_id', $resultId)
                        ->orderBy('prize_level', 'ASC')
                        ->orderBy('id', 'ASC')
                        ->get()
                        ->getResult();
            
            // Organize prizes by section
            $organizedPrizes = [
                'section1' => [],
                'section2' => [],
                'section3' => [],
                'section4' => [],
                'section5' => []
            ];
            
            foreach ($prizes as $prize) {
                switch ($prize->prize_level) {
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
            
            // Format date and time for display
            $drawDate1 = date('d/m/y', strtotime($result->draw_date));
            $drawDate2 = date('d/m/Y', strtotime($result->draw_date));
            $drawTime = date('g A', strtotime($result->draw_time));
            
            return [
                'status' => 'success',
                'data' => [
                    'result_id' => $result->id,
                    'draw_date_short' => $drawDate1,
                    'draw_date_full' => $drawDate2,
                    'draw_time' => $drawTime,
                    'lottery_data' => $organizedPrizes,
                    'status' => $result->status
                ]
            ];
            
        } catch (\Exception $e) {
            log_message('error', 'Error fetching lottery result: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error fetching lottery result'
            ])->setStatusCode(500);
        }
    }
    
    /**
     * Update lottery results - only updates changed items
     * 
     * @return \CodeIgniter\HTTP\Response
     */
    public function updateLotteryResults()
    {
        try {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            
            // Get POST data
            $resultId = $request->getPost('result_id');
            $lotteryData = $request->getPost('lottery_data');
            $drawTime = $request->getPost('draw_time');
            $drawDate = $request->getPost('draw_date');
            
            // Basic validation
            if (!$resultId || !$lotteryData || !$drawTime || !$drawDate) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Missing required fields'
                ])->setStatusCode(400);
            }
            
            // Check if result exists
            $existingResult = $db->table('lottery_results')->where('id', $resultId)->get()->getRow();
            if (!$existingResult) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Lottery result not found'
                ])->setStatusCode(404);
            }
            
            // Convert date and time
            $cleanDate = preg_replace('/(\d+)(st|nd|rd|th)/', '$1', $drawDate);
            $dateObj = \DateTime::createFromFormat('j F Y', $cleanDate);
            $processedDate = $dateObj ? $dateObj->format('Y-m-d') : $existingResult->draw_date;
            
            $cleanTime = preg_replace('/\s*Result\s*$/i', '', trim($drawTime));
            $timeObj = \DateTime::createFromFormat('g A', $cleanTime);
            $processedTime = $timeObj ? $timeObj->format('H:i:s') : $existingResult->draw_time;
            
            // Start transaction
            $db->transStart();
            
            // Update main result if date/time changed
            if ($processedDate !== $existingResult->draw_date || $processedTime !== $existingResult->draw_time) {
                $db->table('lottery_results')->where('id', $resultId)->update([
                    'draw_date' => $processedDate,
                    'draw_time' => $processedTime,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            
            // Get existing prizes
            $existingPrizes = $db->table('lottery_prizes')
                                ->where('result_id', $resultId)
                                ->get()
                                ->getResult();
            
            // Organize existing prizes by level
            $existingByLevel = [];
            foreach ($existingPrizes as $prize) {
                $existingByLevel[$prize->prize_level][] = $prize->prize_number;
            }
            
            // Process each section
            $sectionsMap = [
                'section1' => '1st',
                'section2' => '2nd',
                'section3' => '3rd',
                'section4' => '4th',
                'section5' => '5th'
            ];
            
            $updatedPrizes = 0;
            $currentTime = date('Y-m-d H:i:s');
            
            foreach ($sectionsMap as $section => $prizeLevel) {
                $newPrizes = $lotteryData[$section] ?? [];
                $oldPrizes = $existingByLevel[$prizeLevel] ?? [];
                
                // Remove empty values
                $newPrizes = array_filter($newPrizes, function($prize) {
                    return !empty(trim($prize));
                });
                
                // Check if prizes changed
                if (array_diff($newPrizes, $oldPrizes) || array_diff($oldPrizes, $newPrizes)) {
                    // Delete old prizes for this level
                    $db->table('lottery_prizes')
                       ->where('result_id', $resultId)
                       ->where('prize_level', $prizeLevel)
                       ->delete();
                    
                    // Insert new prizes
                    if (!empty($newPrizes)) {
                        $prizeData = [];
                        foreach ($newPrizes as $prizeNumber) {
                            $prizeData[] = [
                                'result_id' => $resultId,
                                'prize_level' => $prizeLevel,
                                'prize_number' => trim($prizeNumber),
                                'created_at' => $currentTime
                            ];
                        }
                        
                        $db->table('lottery_prizes')->insertBatch($prizeData);
                        $updatedPrizes += count($prizeData);
                    }
                }
            }
            
            // Complete transaction
            $db->transComplete();
            
            if ($db->transStatus() === false) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to update lottery results'
                ])->setStatusCode(500);
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Lottery results updated successfully',
                'data' => [
                    'result_id' => $resultId,
                    'draw_date' => $processedDate,
                    'draw_time' => $processedTime,
                    'updated_prizes' => $updatedPrizes,
                    'prizes_breakdown' => [
                        '1st' => count($lotteryData['section1'] ?? []),
                        '2nd' => count($lotteryData['section2'] ?? []),
                        '3rd' => count($lotteryData['section3'] ?? []),
                        '4th' => count($lotteryData['section4'] ?? []),
                        '5th' => count($lotteryData['section5'] ?? [])
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error updating lottery results: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error occurred'
            ])->setStatusCode(500);
        }
    }

    /**
     * Save lottery results - creates main result and all prize records
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
            
            // Basic validation
            if (!$lotteryData || !$drawTime || !$drawDate) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Missing required fields'
                ])->setStatusCode(400);
            }
            
            // Convert date: "16th July 2025" -> "2025-07-16"
            $cleanDate = preg_replace('/(\d+)(st|nd|rd|th)/', '$1', $drawDate);
            $dateObj = \DateTime::createFromFormat('j F Y', $cleanDate);
            $processedDate = $dateObj ? $dateObj->format('Y-m-d') : date('Y-m-d');
            
            // Convert time: "1 PM Result" -> "13:00:00"
            $cleanTime = preg_replace('/\s*Result\s*$/i', '', trim($drawTime));
            $timeObj = \DateTime::createFromFormat('g A', $cleanTime);
            $processedTime = $timeObj ? $timeObj->format('H:i:s') : date('H:i:s');
            
            // Step 1: Create main lottery result record
            $resultData = [
                'template_id' => 1, // You can get this from POST or set default
                'draw_date' => $processedDate,
                'draw_time' => $processedTime,
                'status' => 'draft',
                'pdf_path' => NULL,
                'pdf_generated_at' => NULL,
                'publish_time' => NULL,
                'created_by' => 1, // You can get this from session or POST
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $insertResult = $db->table('lottery_results')->insert($resultData);
            
            if (!$insertResult) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to create lottery result'
                ])->setStatusCode(500);
            }
            
            // Step 2: Get the inserted lottery result ID
            $resultId = $db->insertID();
            
            // Step 3: Process each section and create prize records
            $prizeData = [];
            $currentTime = date('Y-m-d H:i:s');
            
            // Section 1 - 1st prize (1 record)
            if (isset($lotteryData['section1']) && !empty($lotteryData['section1'])) {
                foreach ($lotteryData['section1'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '1st',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 2 - 2nd prize (10 records)
            if (isset($lotteryData['section2']) && !empty($lotteryData['section2'])) {
                foreach ($lotteryData['section2'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '2nd',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 3 - 3rd prize (10 records)
            if (isset($lotteryData['section3']) && !empty($lotteryData['section3'])) {
                foreach ($lotteryData['section3'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '3rd',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 4 - 4th prize (10 records)
            if (isset($lotteryData['section4']) && !empty($lotteryData['section4'])) {
                foreach ($lotteryData['section4'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '4th',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 5 - 5th prize (100 records)
            if (isset($lotteryData['section5']) && !empty($lotteryData['section5'])) {
                foreach ($lotteryData['section5'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '5th',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Step 4: Insert all prize records
            $insertedPrizes = 0;
            if (!empty($prizeData)) {
                try {
                    // Try batch insert first
                    $prizeInsertResult = $db->table('lottery_prizes')->insertBatch($prizeData);
                    
                    if ($prizeInsertResult) {
                        $insertedPrizes = count($prizeData);
                    } else {
                        // If batch insert fails, try individual inserts
                        foreach ($prizeData as $prize) {
                            $individualResult = $db->table('lottery_prizes')->insert($prize);
                            if ($individualResult) {
                                $insertedPrizes++;
                            }
                        }
                    }
                    
                    if ($insertedPrizes == 0) {
                        // If no prizes were inserted, delete the main result record
                        $db->table('lottery_results')->delete(['id' => $resultId]);
                        
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Failed to create any prize records'
                        ])->setStatusCode(500);
                    }
                    
                } catch (\Exception $e) {
                    log_message('error', 'Prize insertion error: ' . $e->getMessage());
                    // Delete the main result record if prize insertion fails
                    $db->table('lottery_results')->delete(['id' => $resultId]);
                    
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Failed to create prize records: ' . $e->getMessage()
                    ])->setStatusCode(500);
                }
            }
            
            // Success response
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Lottery results saved successfully',
                'data' => [
                    'result_id' => $resultId,
                    'draw_date' => $processedDate,
                    'draw_time' => $processedTime,
                    'total_prizes' => $insertedPrizes,
                    'prizes_breakdown' => [
                        '1st' => count($lotteryData['section1'] ?? []),
                        '2nd' => count($lotteryData['section2'] ?? []),
                        '3rd' => count($lotteryData['section3'] ?? []),
                        '4th' => count($lotteryData['section4'] ?? []),
                        '5th' => count($lotteryData['section5'] ?? [])
                    ]
                ]
            ])->setStatusCode(201);
            
        } catch (\Exception $e) {
            log_message('error', 'Error saving lottery results: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error occurred'
            ])->setStatusCode(500);
        }
    }

    public function view_result($resultId) {
        $lotteryResultData = $this->getLotteryResult($resultId);
        if(!empty($lotteryResultData)) {
            return view('lottery_templates/lottery_template_test', ['lotteryData' => $lotteryResultData]);
        } else {
            return redirect('admin/admin-dashboard');
        }
    }

    public function updateLotteryResultFiles()
    {
        try {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            helper(['filesystem', 'form']);

            $resultId = $request->getPost('result_id');
            if (!$resultId) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Missing result_id'
                ])->setStatusCode(400);
            }

            // Validate that record exists
            $existing = $db->table('lottery_results')->getWhere(['id' => $resultId])->getRow();
            if (!$existing) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Result record not found'
                ])->setStatusCode(404);
            }

            // Handle file uploads
            $pngFile = $request->getFile('png_file');
            $pdfFile = $request->getFile('pdf_file');
            $uploadDir = WRITEPATH . 'uploads/';
            $updateFields = [];

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if ($pngFile && $pngFile->isValid() && !$pngFile->hasMoved()) {
                $pngName = 'lottery_result_' . $resultId . '.png'; // or just $resultId . '.png'
                $pngFile->move($uploadDir, $pngName);
                $updateFields['result_image'] = 'uploads/' . $pngName;
            }

            if ($pdfFile && $pdfFile->isValid() && !$pdfFile->hasMoved()) {
                $pdfName = 'lottery_result_' . $resultId . '.pdf'; // or just $resultId . '.png'
                $pdfFile->move($uploadDir, $pdfName);
                $updateFields['pdf_path'] = 'uploads/' . $pdfName;
                $updateFields['pdf_generated_at'] = date('Y-m-d H:i:s');
            }

            if (!empty($updateFields)) {
                $updateFields['updated_at'] = date('Y-m-d H:i:s');
                $db->table('lottery_results')->update($updateFields, ['id' => $resultId]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'No valid files uploaded'
                ])->setStatusCode(400);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Files uploaded and result updated',
                'data' => [
                    'result_id' => $resultId,
                    'pdf_path' => $updateFields['pdf_path'] ?? null,
                    'image_path' => $updateFields['image_path'] ?? null
                ]
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Update error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error'
            ])->setStatusCode(500);
        }
    }
}