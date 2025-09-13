<?php

require "connection.php";
require "Salt.php";

if (!empty($_SESSION['loginUserID'])) {

    header("Location: dashboard.php");
    exit();

}

if (isset($_POST['login'])) {

    $email = $_POST['email'];
     $pass = $_POST['password'];
         
     $pass = salt($pass);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :email AND Password = :pass LIMIT 1");
    $stmt->execute([
        ':email' => $email,
        ':pass' => $pass
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['loginUserID'] = $user['id'];    
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>

    <div class="login-container">
        <form method="post" class="login-form">
            <h2>LOG IN</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="********" required>
            <button type="submit" name="login">Login</button>
            <div>
                <p>
                    Don't have an account?
                    <a href="signup.php">Sign up</a>
                </p>
            </div>
            <?php if (!empty($error))
                echo "<p class='error'>$error</p>"; ?>
        </form>


    </div>

</body>

</html>