<?php
require "connection.php";
require "Salt.php";


if (isset($_POST['signup'])) {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    // ✅ Encrypt password
    $pass = salt($pass);

    // ✅ Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $pass
    ]);

    $_SESSION['success'] = "Registration successful! Please login.";
    header("Location: login.php");
    exit;
}
?>



<!-- ✅ Signup Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Signup Form</title>
    <!-- css folder ke andar wali file ka path -->
    <link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>

<form method="post" class="signup-form">
    <h2>Create Account</h2>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="signup">Sign Up</button>
    <div class="already">
        <p>Already have an Account?
     <a href="login.php">Login here</a></p>
    </div>
     
</form>

</body>
</html>

