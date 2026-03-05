<?php
// generate_report.php (corrected: dept_id treated as string)
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';

require_once 'fpdf/fpdf/fpdf.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper - safe redirect with JS alert
function js_alert_and_back($msg, $redirect = 'attendancereport.php') {
    $escaped = addslashes($msg);
    echo "<script>alert('{$escaped}'); window.location.href = '{$redirect}';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    js_alert_and_back('Invalid access method. Use the report form.');
}

// Collect + basic validation
// NOTE: dept_id is string in your DB (e.g., 'CSE'), so do NOT cast to int
$dept_id    = isset($_POST['dept_id']) ? trim($_POST['dept_id']) : '';
$section_id = isset($_POST['section_id']) ? (int) $_POST['section_id'] : 0;
$semester   = isset($_POST['semester']) ? (int) $_POST['semester'] : 0;
$subject    = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$month      = isset($_POST['month']) ? (int) $_POST['month'] : 0;
$year       = isset($_POST['year']) ? (int) $_POST['year'] : 0;

// Validate required fields
if ($dept_id === '' || $section_id <= 0 || $semester <= 0 || $subject === '' || $month < 1 || $month > 12 || $year < 2000) {
    js_alert_and_back('Please provide valid Department, Section, Semester, Subject, Month and Year.');
}

// Verify the selected section belongs to the selected department
$chk_section_sql = "SELECT s.section_id, s.section_name, d.dept_name
                    FROM sections s
                    JOIN departments d ON s.dept_id = d.dept_id
                    WHERE s.section_id = ? AND d.dept_id = ? LIMIT 1";
$chk_stmt = $conn->prepare($chk_section_sql);
if ($chk_stmt === false) {
    js_alert_and_back('Server error (section check prepare failed).');
}
// section_id is int, dept_id is string => "is"
$chk_stmt->bind_param("is", $section_id, $dept_id);
$chk_stmt->execute();
$chk_res = $chk_stmt->get_result();
if ($chk_res === false || $chk_res->num_rows === 0) {
    $chk_stmt->close();
    js_alert_and_back('Selected section does not belong to selected department.');
}
$meta = $chk_res->fetch_assoc();
$section_name = $meta['section_name'];
$dept_name = $meta['dept_name'];
$chk_stmt->close();

// 1) Section-aware existence check (attendance rows for the given filter)
$check_sql = "SELECT COUNT(*) AS total
              FROM attendance a
              JOIN students s ON a.student_id = s.student_id
              WHERE s.section_id = ?
                AND a.subject = ?
                AND a.semester = ?
                AND MONTH(a.date) = ?
                AND YEAR(a.date) = ?";

$check_stmt = $conn->prepare($check_sql);
if ($check_stmt === false) {
    js_alert_and_back('Server error (attendance existence prepare failed).');
}
$check_stmt->bind_param("isiii", $section_id, $subject, $semester, $month, $year);
$check_stmt->execute();
$check_total = (int) $check_stmt->get_result()->fetch_assoc()['total'];
$check_stmt->close();

if ($check_total === 0) {
    js_alert_and_back('No attendance records found for the selected Department/Section/Semester/Subject for the given month and year or provide valid input.');
}

// 2) Compute class_total_lectures (distinct lecture dates)
$lect_sql = "SELECT COUNT(DISTINCT DATE(a.date)) AS total_lectures
             FROM attendance a
             JOIN students s ON a.student_id = s.student_id
             WHERE s.section_id = ?
               AND a.subject = ?
               AND a.semester = ?
               AND MONTH(a.date) = ?
               AND YEAR(a.date) = ?";
$lect_stmt = $conn->prepare($lect_sql);
if ($lect_stmt === false) {
    js_alert_and_back('Server error (lectures count prepare failed).');
}
$lect_stmt->bind_param("isiii", $section_id, $subject, $semester, $month, $year);
$lect_stmt->execute();
$total_lectures = (int) $lect_stmt->get_result()->fetch_assoc()['total_lectures'];
$lect_stmt->close();

if ($total_lectures === 0) {
    js_alert_and_back('No distinct lecture dates found for the given filter. Cannot generate report.');
}

// 3) Aggregated student attendance (LEFT JOIN ensures students with zero records are included)
// Note: We accept a few common present tokens: 'present', 'p', '1' (case-insensitive). Adjust as needed.
$agg_sql = "SELECT s.student_id, s.name, s.roll_no,
                   COALESCE(SUM(
                       CASE 
                           WHEN LOWER(a.status) IN ('present','p','1') THEN 1 
                           ELSE 0 
                       END
                   ), 0) AS present_days,
                   COALESCE(COUNT(a.student_id), 0) AS recorded_days
            FROM students s
            LEFT JOIN attendance a ON s.student_id = a.student_id
              AND a.subject = ?
              AND a.semester = ?
              AND MONTH(a.date) = ?
              AND YEAR(a.date) = ?
            WHERE s.section_id = ?
            GROUP BY s.student_id
            ORDER BY s.roll_no ASC";

$agg_stmt = $conn->prepare($agg_sql);
if ($agg_stmt === false) {
    js_alert_and_back('Server error (aggregation prepare failed).');
}
// bind: subject (s), semester (i), month (i), year (i), section_id (i)
$agg_stmt->bind_param("siiii", $subject, $semester, $month, $year, $section_id);
$agg_stmt->execute();
$students_result = $agg_stmt->get_result();
if ($students_result === false) {
    js_alert_and_back('Server error retrieving student attendance.');
}

// --- Generate PDF using FPDF ---
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);

// Header
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 8, "Attendance Report", 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', '', 11);
$metaLine = sprintf("%s | Section: %s | Sem: %d | Subject: %s | %02d/%d | Lectures: %d",
    $dept_name,
    $section_name,
    $semester,
    $subject,
    $month,
    $year,
    $total_lectures
);
$pdf->Cell(0, 7, $metaLine, 0, 1, 'C');
$pdf->Ln(6);

// Table headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(12, 9, 'S.No', 1, 0, 'C');
$pdf->Cell(70, 9, 'Name', 1, 0, 'L');
$pdf->Cell(30, 9, 'Roll No', 1, 0, 'C');
$pdf->Cell(20, 9, 'Present', 1, 0, 'C');
$pdf->Cell(20, 9, 'Absent', 1, 0, 'C');
$pdf->Cell(28, 9, 'Attendance %', 1, 1, 'C');

$pdf->SetFont('Arial', '', 11);

$sno = 1;
$total_attendance_percent = 0;
$total_students = 0;

while ($row = $students_result->fetch_assoc()) {
    $student_id     = (int) $row['student_id'];
    $name           = $row['name'];
    $roll_no        = $row['roll_no'];
    $present_days   = (int) $row['present_days'];
    $absent_days    = max(0, $total_lectures - $present_days);
    $attendance_percentage = $total_lectures > 0
        ? round(($present_days / $total_lectures) * 100, 2)
        : 0.00;

    $total_attendance_percent += $attendance_percentage;
    $total_students++;

    $pdf->Cell(12, 8, $sno++, 1, 0, 'C');
    $nameToPrint = (strlen($name) > 60) ? substr($name, 0, 57) . '...' : $name;
    $pdf->Cell(70, 8, $nameToPrint, 1, 0, 'L');
    $pdf->Cell(30, 8, $roll_no, 1, 0, 'C');
    $pdf->Cell(20, 8, $present_days, 1, 0, 'C');
    $pdf->Cell(20, 8, $absent_days, 1, 0, 'C');
    $pdf->Cell(28, 8, $attendance_percentage . '%', 1, 1, 'C');
}

if ($total_students > 0) {
    $class_average = round($total_attendance_percent / $total_students, 2);
    $pdf->Ln(6);
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(0, 8, "Average Class Attendance: {$class_average} %", 0, 1, 'C');
}

$pdf->SetFont('Arial', 'I', 8);
$pdf->Ln(4);
$pdf->MultiCell(0, 5, "Note: Attendance % = (Present days / Total lectures for selected period) * 100. Total lectures = {$total_lectures} (distinct lecture dates).", 0, 'L');

// Output file
$filename = sprintf("attendance_report_%s_section%s_sem%d_%02d_%d.pdf",
    preg_replace('/[^A-Za-z0-9_-]/', '_', $dept_name),
    preg_replace('/[^A-Za-z0-9_-]/', '_', $section_name),
    $semester,
    $month,
    $year
);

$agg_stmt->close();
$conn->close();

$pdf->Output('D', $filename);
exit();
?>
