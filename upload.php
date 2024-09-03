<?php
require_once 'vendor/autoload.php'; // Ensure Composer's autoload is included

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PdfReader;

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];

        // Check if the file is a PDF
        if ($fileType !== 'application/pdf') {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Please upload a PDF file.']);
            exit;
        }

        // Create a new FPDI instance and set the source file
        $pdf = new Fpdi();
        try {
            $pdf->setSourceFile($fileTmpPath);
            $pageCount = $pdf->setSourceFile($fileTmpPath);

            // Convert page count to words
            $pageWords = numberToWords($pageCount);

            echo json_encode(['success' => true, 'message' => "The PDF has $pageCount pages. ($pageWords)"]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error processing PDF file.']);
        }
    } else {
        // Detailed error reporting
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $error = 'Missing a temporary folder.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $error = 'Failed to write file to disk.';
                break;
            case UPLOAD_ERR_EXTENSION:
                $error = 'A PHP extension stopped the file upload.';
                break;
            default:
                $error = 'Unknown upload error.';
                break;
        }
        echo json_encode(['success' => false, 'message' => $error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Function to convert numbers to words
function numberToWords($number) {
    $words = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        // Add more number-to-word mappings as needed
    ];

    if (isset($words[$number])) {
        return $words[$number];
    }

    return 'more than ten'; // Default for numbers beyond the predefined range
}
?>
