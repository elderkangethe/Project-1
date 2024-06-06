<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require('fpdf.php');
include('config.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'User Records', 0, 1, 'C');
        $this->Ln(10);
        $this->Cell(10, 10, 'ID', 1);
        $this->Cell(30, 10, 'Username', 1);
        $this->Cell(30, 10, 'First Name', 1);
        $this->Cell(30, 10, 'Surname', 1);
        $this->Cell(20, 10, 'Gender', 1);
        $this->Cell(40, 10, 'Date of Birth', 1);
        $this->Ln();
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Table with data
    function UserTable($header, $data)
    {
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            $this->Cell(10, 10, $row['id'], 1);
            $this->Cell(30, 10, $row['username'], 1);
            $this->Cell(30, 10, $row['firstname'], 1);
            $this->Cell(30, 10, $row['surname'], 1);
            $this->Cell(20, 10, $row['gender'], 1);
            $this->Cell(40, 10, $row['dob'], 1);
            $this->Ln();
        }
    }
}

// Get filter values
$username = $_GET['username'] ?? '';
$age = $_GET['age'] ?? '';
$gender = $_GET['gender'] ?? '';

// Calculate age from date of birth
if ($age) {
    $age_condition = "YEAR(CURDATE()) - YEAR(dob) = '$age'";
} else {
    $age_condition = "1";
}

// Build SQL query
$sql = "SELECT * FROM users WHERE username LIKE '%$username%' AND $age_condition AND gender LIKE '%$gender%'";
$result = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Create PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->UserTable(['ID', 'Username', 'First Name', 'Surname', 'Gender', 'Date of Birth'], $data);
$pdf->Output();
?>
