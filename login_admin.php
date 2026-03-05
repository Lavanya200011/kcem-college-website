<?php
include 'includes/db.php';
session_start();

$error="";

if(isset($_POST['login'])){
$user=$_POST['username'];
$pass=$_POST['password'];

$sql="SELECT * FROM admins WHERE username='$user' AND password='$pass'";
$res=$conn->query($sql);

if($res->num_rows>0){
$_SESSION['admin']=$user;
header("Location: dashboard_admin.php");
exit();
}
else{
$error="Invalid Admin Credentials";
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

<div class="text-center mt-4 text-sm text-gray-500">
KCEM Administrator Panel
</div>

</div>

</div>

</body>
</html>