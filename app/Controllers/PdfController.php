<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends BaseController
{
    public function generatePdf()
    {
        // Sample data to pass to the template
        $data = [
            'title' => 'Test PDF Document',
            'date' => date('Y-m-d H:i:s'),
            'content' => 'This is a test PDF generated from CodeIgniter 4 using DomPDF.',
            'items' => [
                ['name' => 'Item 1', 'price' => 100],
                ['name' => 'Item 2', 'price' => 200],
                ['name' => 'Item 3', 'price' => 150]
            ]
        ];

        // Load the template view
        $html = view('lottery_templates/lottery_template1', $data);

        // Create DomPDF instance
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isPhpEnabled', true);
        
        $dompdf = new Dompdf($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the PDF
        $dompdf->render();
        
        // Generate filename
        $filename = 'test_pdf_' . date('Y-m-d_H-i-s') . '.pdf';
        
        // Save PDF to writable/pdfs folder
        $pdfContent = $dompdf->output();
        $pdfPath = WRITEPATH . 'pdfs/' . $filename;
        
        // Create directory if it doesn't exist
        if (!is_dir(WRITEPATH . 'pdfs/')) {
            mkdir(WRITEPATH . 'pdfs/', 0755, true);
        }
        
        // Save the file
        file_put_contents($pdfPath, $pdfContent);
        
        // Return response
        return $this->response->setJSON([
            'success' => true,
            'message' => 'PDF generated successfully!',
            'filename' => $filename,
            'path' => $pdfPath
        ]);
    }
    
    public function downloadPdf()
    {
        // Sample data
        $data = [
            'title' => 'Download Test PDF',
            'date' => date('Y-m-d H:i:s'),
            'content' => 'This PDF will be downloaded directly.',
            'items' => [
                ['name' => 'Download Item 1', 'price' => 300],
                ['name' => 'Download Item 2', 'price' => 400]
            ]
        ];

        // Load the template view
        $html = view('lottery_templates/lottery_template1', $data);

        // Create DomPDF instance
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Stream the PDF to browser for download
        $dompdf->stream('test_document.pdf', ['Attachment' => true]);
    }
}