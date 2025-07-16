<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\Controller;

class PdfGenerator extends Controller
{
    public function generateLotteryResult()
    {
        // Dynamic data – can come from DB or form
        $data = [
            'first_number' => '569821',
            'draw_number' => '007',
            'draw_date' => '14/07/2025',
        
            'second_prize_numbers' => [
                '10234', '11245', '12356', '13467', '14578',
                '15689', '16790', '17891', '18902', '19013'
            ],
        
            'third_prize_numbers' => [
                '2034', '2134', '2234', '2334', '2434',
                '2534', '2634', '2734', '2834', '2934'
            ],
        
            'fourth_prize_numbers' => [
                '3045', '3145', '3245', '3345', '3445',
                '3545', '3645', '3745', '3845', '3945'
            ],
        
            'fifth_prize_numbers' => [
                '4001', '4002', '4003', '4004', '4005',
                '4006', '4007', '4008', '4009', '4010',
                '4011', '4012', '4013', '4014', '4015',
                '4016', '4017', '4018', '4019', '4020',
                '4021', '4022', '4023', '4024', '4025',
                '4026', '4027', '4028', '4029', '4030',
                '4031', '4032', '4033', '4034', '4035',
                '4036', '4037', '4038', '4039', '4040',
                '4041', '4042', '4043', '4044', '4045',
                '4046', '4047', '4048', '4049', '4050',
                '4051', '4052', '4053', '4054', '4055',
                '4056', '4057', '4058', '4059', '4060',
                '4061', '4062', '4063', '4064', '4065',
                '4066', '4067', '4068', '4069', '4070',
                '4071', '4072', '4073', '4074', '4075',
                '4076', '4077', '4078', '4079', '4080',
                '4081', '4082', '4083', '4084', '4085',
                '4086', '4087', '4088', '4089', '4090',
                '4091', '4092', '4093', '4094', '4095',
                '4096', '4097', '4098', '4099', '4100'
            ]
        ];
        

         // Step 2: Load the view and get HTML content
        $html = view('lottery_templates/lottery_template1', $data);

        // Step 3: Setup save path and filename
        $filename = 'lottery_result_' . date('Y-m-d-H') . '.html';
        $savePath = WRITEPATH . 'html/' . $filename;

        // Ensure directory exists
        if (!is_dir(WRITEPATH . 'html')) {
            mkdir(WRITEPATH . 'html', 0777, true);
        }

        // Step 4: Save HTML content to file
        file_put_contents($savePath, $html);

        // Step 5: Return response with link to saved HTML
        return $this->response->setJSON([
            'status'   => 'success',
            'message'  => 'HTML saved successfully',
            'filename' => $filename,
            'path'     => $savePath,
            'url'      => base_url('writable/html/' . $filename),
        ]);
    }

    public function download($filename)
    {
        $path = WRITEPATH . 'html/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
                    ->setHeader('Content-Type', 'text/html; charset=UTF-8')
                    ->setBody(file_get_contents($path));
    }



    public function uploadPdf()
    {
        $file = $this->request->getFile('file');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid PDF upload']);
        }

        $filename = 'lottery_result_' . date('Ymd_His') . '.pdf';
        $savePath = WRITEPATH . 'pdfs/' . $filename;

        // Ensure the directory exists
        if (!is_dir(WRITEPATH . 'pdfs')) {
            mkdir(WRITEPATH . 'pdfs', 0777, true);
        }

        // Move uploaded file to destination
        $file->move(WRITEPATH . 'pdfs', $filename);

        return $this->response->setJSON([
            'status'   => 'success',
            'message'  => 'PDF uploaded successfully',
            'filename' => $filename,
            'url'      => base_url('writable/pdfs/' . $filename)
        ]);
    }

}