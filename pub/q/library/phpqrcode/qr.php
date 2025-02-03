<?php
// Include the PHP QR Code library
include 'phpqrcode/qrlib.php';

// Directory to save the generated QR Code
$qrDir = 'qrcodes/';
if (!file_exists($qrDir)) {
    mkdir($qrDir); // Create the directory if it doesn't exist
}

// Text or URL to encode in the QR Code
$qrText = "https://www.example.com";

// Filepath to save the QR Code
$filePath = $qrDir . 'example_qr.png';

// QR Code error correction level and size
$errorCorrectionLevel = 'L'; // 'L', 'M', 'Q', 'H'
$matrixPointSize = 10;

// Generate the QR Code and save it as a PNG file
QRcode::png($qrText, $filePath, $errorCorrectionLevel, $matrixPointSize);

// Output the generated QR Code to the browser
echo "<h3>Generated QR Code:</h3>";
echo "<img src='$filePath' alt='QR Code'>";
?>