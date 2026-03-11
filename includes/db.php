<?php
$servername = "sql212.infinityfree.com"; // From your MySQL Host Name column
$username   = "if0_38879727";           // From your MySQL User Name column
$password   = "Lavanyath";   // This is your unique Hosting Password
$dbname     = "if0_38879727_kcem_portal"; // From your MySQL DB Name column

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>