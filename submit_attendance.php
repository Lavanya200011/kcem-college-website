<?php
// Database connection
$conn = new mysqli(
    "sql212.infinityfree.com",
    "if0_38879727",
    "Lavanyath", 
    "if0_38879727_kcem_portal"
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    
    $statusArray = $_POST['status'];
    $semester = (int)$_POST['semester'];
    $date = $_POST['date'];
    $lecture = (int)$_POST['lecture'];
    $subject = $_POST['subject'];

    $sql  = "INSERT INTO attendance (student_id, semester, date, lecture, subject, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($statusArray as $student_id => $status) {
        $stmt->bind_param("iisiss", $student_id, $semester, $date, $lecture, $subject, $status);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // REDIRECT back to the form with a success parameter
    header("Location: mark_attendance.php?success=1");
    exit();
} else {
    header("Location: mark_attendance.php");
    exit();
}
?>