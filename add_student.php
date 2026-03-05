<?php
include 'includes/db.php';

if(isset($_POST['add'])){
$prn=$_POST['prn'];
$name=$_POST['name'];
$pass=$_POST['password'];

$sql="INSERT INTO students(prn,name,password) VALUES('$prn','$name','$pass')";
$conn->query($sql);
}
?>

<form method="post">
<input name="prn">
<input name="name">
<input name="password">
<button name="add">Add Student</button>
</form>