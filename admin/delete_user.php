<?php
include '../includes/db.php';

// Check if parameters exist to avoid errors
if (isset($_GET['type']) && isset($_GET['id'])) {
    
    $type = $_GET['type'];
    $id = intval($_GET['id']); // intval() adds a basic layer of security

    if ($type == "student") {
        $conn->query("DELETE FROM students WHERE student_id = $id");
        header("Location: manage_student.php");
        exit();
    } 
    elseif ($type == "teacher") {
        $conn->query("DELETE FROM teachers WHERE teacher_id = $id");
        header("Location: manage_teacher.php");
        exit();
    } 
    elseif ($type == "admin") {
        $conn->query("DELETE FROM admins WHERE id = $id");
        header("Location: manage_admin.php");
        exit();
    }
} else {
    // If no ID or Type is provided, send them back to the dashboard
    header("Location: ../dashboard_admin.php");
    exit();
}
?>