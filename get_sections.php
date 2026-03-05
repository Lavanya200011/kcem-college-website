<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';

header('Content-Type: text/html; charset=utf-8');

/* DB connection */
if ($conn->connect_error) {
    // Return a valid option so the frontend shows an error state
    echo "<option value=''>Error connecting to DB</option>";
    exit;
}

if (!isset($_GET['dept_id']) || $_GET['dept_id'] === '') {
    echo "<option value=''>-- Select Section --</option>";
    $conn->close();
    exit;
}

$dept_id = $_GET['dept_id'];

/* Prepared statement to avoid injection even if you sanitize earlier */
$stmt = $conn->prepare("SELECT section_id, section_name FROM sections WHERE dept_id = ? ORDER BY section_name");
$stmt->bind_param('s', $dept_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res === false) {
    echo "<option value=''>Error loading sections</option>";
} elseif ($res->num_rows === 0) {
    echo "<option value=''>No sections available</option>";
} else {
    echo "<option value=''>-- Select Section --</option>";
    while ($row = $res->fetch_assoc()) {
        $id = htmlspecialchars($row['section_id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($row['section_name'], ENT_QUOTES, 'UTF-8');
        // Output more descriptive label if needed, e.g., "A (Section ID: 3)" or "CSE - A"
        echo "<option value=\"{$id}\">Section {$name}</option>";
    }
}

$stmt->close();
$conn->close();
?>
