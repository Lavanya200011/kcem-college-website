<?php
include '../includes/db.php';

// Check if 'type' exists, otherwise default to empty
$type = $_GET['type'] ?? '';

// Check both 'student_id' AND 'id' just in case
$id = $_GET['student_id'] ?? $_GET['id'] ?? null;

if(isset($_POST['reset']) && $id) {
    $new = $_POST['password'];

    if($type == "student") {
        // Double check: Is the column in MySQL actually 'student_id' or 'id'?
        $conn->query("UPDATE students SET password='$new' WHERE student_id=$id");
    }
    elseif($type == "teacher") {
        $conn->query("UPDATE teachers SET password='$new' WHERE id=$id");
    }
    elseif($type == "admin") {
        $conn->query("UPDATE admins SET password='$new' WHERE id=$id");
    }

    header("Location: ../dashboard_admin.php");
    exit();
}
?>

<form method="post">
    <label>New Password</label>
    <input name="password" type="password" required>
    <button name="reset">Reset</button>
</form>