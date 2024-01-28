<?php
require_once('../tcpdf/tcpdf.php'); // Adjust the path to the TCPDF library

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('Sandesh & Asmita');
$pdf->SetAuthor('Sandesh & Asmita');
$pdf->SetTitle('Complaint Records');

// Add a page
$pdf->AddPage();

// Set font for the header and content
$pdf->SetFont('times', '', 10); // Times New Roman, size 12

// Add the header
$pdf->Cell(0, 0, 'Complaint Records', 0, 1, 'C');

// Add download date and time in 12-hour format
$dateTime = new DateTime('now', new DateTimeZone('Asia/Kathmandu'));
$pdf->Cell(0, 2, 'Download Date/Time: ' . $dateTime->format('Y-m-d g:i:s A'), 0, 1, 'C');

// Connect to the MySQL database
$con = mysqli_connect('localhost', 'root', '', 'complaint_project');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Select data from the MySQL table
$query = "SELECT * FROM complain_details";
$result = $con->query($query);

// Define an HTML table to format the data
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">'; // Added border-collapse and set width to 100%
$html .= '<tr>';
$html .= '<th style="width: 26px; text-align: center; vertical-align: middle; font-weight: bold;">S.N</th>';
$html .= '<th style="width: 100px; text-align: center; vertical-align: middle; font-weight: bold;">Name</th>';
$html .= '<th style="width: 75px; text-align: center; vertical-align: middle; font-weight: bold;">Contact</th>';
$html .= '<th style="width: 280px; text-align: center; text-justify: inter-word; padding: 5px; vertical-align: middle; font-weight: bold;">Description</th>';
$html .= '<th style="width: 60px; text-align: center; vertical-align: middle; font-weight: bold;">Status</th>';
$html .= '</tr>';




// Initialize a variable to keep track of the serial number
$serialNumber = 1;

// Loop through the records and add them to the HTML table
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $serialNumber . '</td>'; // Auto-incrementing serial number
    $html .= '<td>' . $row['name'] . '</td>';
    $html .= '<td>' . $row['phone'] . '</td>';
    $html .= '<td>' . $row['complain_description'] . '</td>';
    $html .= '<td>' . $row['status'] . '</td>';
    $html .= '</tr>';

    // Increment the serial number
    $serialNumber++;
}
$html .= '</table>';

// Add the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF to the browser with the option to download it
$pdf->Output('Sandesh_Asmita_Project.pdf', 'D');

// Close the database connection
$con->close();
?>
