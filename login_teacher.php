<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {

        $sql = "SELECT * FROM teachers WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $_SESSION['teacher_loggedin'] = true;
            $_SESSION['teacher_email'] = $email;

            header("Location: dashboard_teacher.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }

        $stmt->close();
    } else {
        $error = "Please enter email and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Login</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-200 flex items-center justify-center min-h-screen">

<div class="bg-indigo-500 shadow-lg rounded-xl p-8 w-full max-w-md">

<h2 class="text-2xl font-bold text-center mb-6 text-white">
Teacher Login
</h2>

<?php if($error != ""): ?>
<div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">
<?php echo $error; ?>
</div>
<?php endif; ?>

<form class="space-y-4" method="post">

<div>
<label class="block text-sm font-medium text-white">Email</label>
<input 
type="email" 
name="email" 
required 
class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
</div>

<div>
<label class="block text-sm font-medium text-white">Password</label>
<input 
type="password" 
name="password" 
required 
class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
</div>

<button 
type="submit"
class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700">
Login
</button>

</form>

<div class="mt-4 text-center">
<a href="index.php" class="text-sm text-white hover:underline">
← Back to Home
</a>
</div>

</div>

</body>
</html>