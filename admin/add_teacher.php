<?php
include '../includes/db.php';

if(isset($_POST['add'])){

$name=$_POST['name'];
$email=$_POST['email'];
$department=$_POST['department'];
$password=$_POST['password'];

$conn->query("INSERT INTO teachers(name,email,department,password)
VALUES('$name','$email','$department','$password')");

header("Location: manage_teachers.php");

}
?>

<form method="post">

Name <input name="name"><br>
Email <input name="email"><br>
Department <input name="department"><br>
Password <input name="password"><br>

<button name="add">Create Teacher</button>

</form>