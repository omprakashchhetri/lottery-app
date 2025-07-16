<?php
namespace App\Controllers;

class Home extends BaseController
{
    // Index Page
    public function index()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set('Asia/Kolkata'); // Set timezone to IST
        
        $currentTime = date('H:i:s');
        $currentDate = date('Y-m-d');
        $startOfDay = date('Y-m-d 00:00:00');
        $endOfDay = date('Y-m-d 23:59:59');
        
        // Get today's results
        $results = $db->table('lottery_results')
            ->where('created_at >=', $startOfDay)
            ->where('created_at <=', $endOfDay)
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
        
        // Process results with fallback logic
        $processedResults = [
            '1pm' => $this->getBestAvailableResult($db, $resultArray['1pm-result'], '13:00:00', $currentTime, $currentDate),
            '8pm' => $this->getBestAvailableResult($db, $resultArray['8pm-result'], '20:00:00', $currentTime, $currentDate)
        ];
        
        $passToView = [
            'title' => 'Meghalaya State Lotteries',
            'resultArray' => $resultArray,
            'processedResults' => $processedResults,
            'currentTime' => $currentTime,
            'currentDate' => $currentDate
        ];
        
        return view('templates/header', $passToView)
            . view('pages/index')
            . view('templates/footer');
    }
    
    /**
     * Get the best available result (current day or previous day fallback)
     */
    private function getBestAvailableResult($db, $currentResult, $targetTime, $currentTime, $currentDate)
    {
        // Check if current day result is available and should be shown
        if ($currentResult && 
            $currentTime >= $targetTime && 
            $currentResult->draw_date == $currentDate && 
            $currentResult->status == 'published') {
            return [
                'result' => $currentResult,
                'showDownload' => true,
                'showImage' => true,
                'message' => null,
                'isCurrentDay' => true
            ];
        }
        
        // If time hasn't passed yet, show message but check for previous day result
        if ($currentTime < $targetTime) {
            // Try to get previous day result to show as fallback
            $previousResult = $db->table('lottery_results')
                ->where('draw_time', $targetTime)
                ->where('status', 'published')
                ->where('draw_date <', $currentDate)
                ->orderBy('draw_date', 'DESC')
                ->limit(1)
                ->get()
                ->getRow();
                
            if ($previousResult) {
                return [
                    'result' => $previousResult,
                    'showDownload' => false,
                    'showImage' => true,
                    'message' => 'Showing previous result. Today\'s result will be available at ' . date('g:i A', strtotime($targetTime)),
                    'isCurrentDay' => false
                ];
            }
            
            return [
                'result' => null,
                'showDownload' => false,
                'showImage' => false,
                'message' => 'Result will be available at ' . date('g:i A', strtotime($targetTime)),
                'isCurrentDay' => false
            ];
        }
        
        // Time has passed but current day result is not available or not published
        // Try to get previous day result as fallback
        $previousResult = $db->table('lottery_results')
            ->where('draw_time', $targetTime)
            ->where('status', 'published')
            ->where('draw_date <', $currentDate)
            ->orderBy('draw_date', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();
            
        if ($previousResult) {
            $message = 'Showing previous result. ';
            if (!$currentResult) {
                $message .= 'Today\'s result not yet created.';
            } elseif ($currentResult->status == 'draft') {
                $message .= 'Today\'s result is being processed.';
            } else {
                $message .= 'Today\'s result not available.';
            }
            
            return [
                'result' => $previousResult,
                'showDownload' => false,
                'showImage' => true,
                'message' => $message,
                'isCurrentDay' => false
            ];
        }
        
        // No previous result available either
        if (!$currentResult) {
            $message = 'Result not yet created.';
        } elseif ($currentResult->status == 'draft') {
            $message = 'Result is being processed...';
        } else {
            $message = 'Result not available.';
        }
        
        return [
            'result' => null,
            'showDownload' => false,
            'showImage' => false,
            'message' => $message,
            'isCurrentDay' => false
        ];
    }
    
    // Old Result Page
    // Old Result Page
    public function old_results()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set('Asia/Kolkata'); // Set timezone to IST
        $currentTime = date('H:i:s');
        $currentDate = date('Y-m-d');
        
        // Get all previous published results (not current date)
        $oldResults = $db->table('lottery_results')
            ->where('status', 'published')
            ->where('draw_date <', $currentDate)
            ->orderBy('draw_date', 'DESC')
            ->orderBy('draw_time', 'DESC')
            ->get()
            ->getResult();
        
        $passToView = [
            'title' => 'Old Results - Meghalaya State Lotteries',
            'oldResults' => $oldResults
        ];
        
        return view('templates/header', $passToView)
            . view('pages/old-result')
            . view('templates/footer');
    }
    
    public function showImage($filename)
    {
        $filepath = WRITEPATH . 'uploads/' . $filename;
        
        if (file_exists($filepath)) {
            $mime = mime_content_type($filepath);
            
            return $this->response
                ->setHeader('Content-Type', $mime)
                ->setBody(file_get_contents($filepath));
        }
        
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
    
    public function downloadPdf($filename)
    {
        $filepath = WRITEPATH . 'uploads/' . $filename;
        
        if (file_exists($filepath)) {
            return $this->response->download($filepath, null);
        }
        
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
}