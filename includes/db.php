<?php
$conn = new mysqli("localhost","root","","kcem_portal");

if($conn->connect_error){
die("Database Connection Failed");
}
?>