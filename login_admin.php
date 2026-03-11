<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);



include 'includes/db.php';

session_start();



$error = "";



if ($_SERVER["REQUEST_METHOD"] === "POST") {



$username = $_POST['username'] ?? '';

$password = $_POST['password'] ?? '';



if (!empty($username) && !empty($password)) {



$sql = "SELECT * FROM admins WHERE username = ? AND password = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $username, $password);

$stmt->execute();

$result = $stmt->get_result();



if ($result->num_rows === 1) {



$_SESSION['admin_loggedin'] = true;

$_SESSION['admin_username'] = $username;



header("Location: dashboard_admin.php");

exit();

} else {

$error = "Invalid username or password";

}



$stmt->close();

} else {

$error = "Please enter username and password.";

}

}

?>



<!DOCTYPE html>

<html>

<head>

<title>Admin Login | KCEM Smart Campus</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>



<body class="bg-gray-100">



<!-- Header -->

<header class="bg-white shadow p-4 flex justify-between items-center">

<h1 class="text-xl font-bold text-red-600">KCEM Smart Campus Portal</h1>



<a href="index.php" class="text-red-600 font-semibold">

⬅ Back to Home

</a>

</header>



<!-- Login Card -->

<div class="flex items-center justify-center min-h-screen">



<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">



<h2 class="text-2xl font-bold text-center mb-6">

Admin Login

</h2>



<?php if($error!=""){ ?>

<div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">

<?php echo $error ?>

</div>

<?php } ?>

<!-- login crendentials -->

<form method="post" class="space-y-4">



<div>

<label class="block text-sm font-medium text-gray-700">Username</label>

<input

type="text"

name="username"

required

placeholder="Enter admin username"

class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"

>

</div>



<div>

<label class="block text-sm font-medium text-gray-700">Password</label>

<input

type="password"

name="password"

required

placeholder="Enter password"

class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"

>

</div>



<button

type="submit"

name="login"

class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition"

>

Login

</button>



</form>
    </html>