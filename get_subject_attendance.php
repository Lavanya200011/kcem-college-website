<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';

session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;
$subject    = isset($_GET['subject']) ? $_GET['subject'] : '';
$month      = $_GET['month'] ?? '';
$year       = $_GET['year'] ?? '';

if (!$student_id || $subject === '') {
    echo "<p class='text-red-600'>Invalid request.</p>";
    exit;
}

// ALL months ka case:
//  - month='all' ya year='all'
//  - ya month/year empty aaye to bhi all treat karo
if ($month === 'all' || $year === 'all' || $month === '' || $year === '') {
    $sql = "SELECT date, status 
            FROM attendance 
            WHERE student_id = ? AND subject = ?
            ORDER BY date ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $student_id, $subject);
} else {
    // Specific month/year filter (teacher filter wali case)
    $month = (int)$month;
    $year  = (int)$year;

    $sql = "SELECT date, status 
            FROM attendance 
            WHERE student_id = ? AND subject = ?
              AND MONTH(date) = ? AND YEAR(date) = ?
            ORDER BY date ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isii", $student_id, $subject, $month, $year);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p class='text-red-600'>No records found for this subject.</p>";
    exit;
}

// Output list inside modal
echo "<div class='space-y-2'>";
while ($row = $result->fetch_assoc()) {
    $d = date('d-m-Y', strtotime($row['date']));
    $statusClass = ($row['status'] === 'Present') ? 'text-green-600' : 'text-red-600';
    echo "<div class='flex justify-between border-b pb-1'>
            <span class='font-medium'>$d</span>
            <span class='$statusClass'>{$row['status']}</span>
          </div>";
}
echo "</div>";

$stmt->close();
$conn->close();
