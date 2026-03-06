<?php
include '../includes/db.php';

$type=$_GET['type'];
$id=$_GET['id'];

if($type=="student")
$conn->query("DELETE FROM students WHERE id=$id");

if($type=="teacher")
$conn->query("DELETE FROM teachers WHERE id=$id");

if($type=="admin")
$conn->query("DELETE FROM admins WHERE id=$id");

header("Location: dashboard_admin.php");
?>