<?php


require "connection.php"; // ✅ already starts session

// 🔒 If user is not logged in → redirect
if (empty($_SESSION['loginUserID'])) {
    header("Location: login.php");
    exit();
}

// ✅ Get user ID from session
$id = $_SESSION['loginUserID'];

try {
    // Fetch user info from correct table/columns
    $stmt = $pdo->prepare("SELECT Name, Email FROM users WHERE id = :id LIMIT 1");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $full_name = $user['Name'];   // matches your DB column
        $email     = $user['Email'];  // matches your DB column
    } else {
        $full_name = "User";
        $email     = "N/A";
    }

} catch (PDOException $e) {
    die("❌ Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:#f4f7fb;
            margin:0;
            padding:0;
        }
        .container {
            max-width: 700px;
            margin:60px auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }
        h1 {
            color:#0a66c2;
            margin-bottom:10px;
        }
        p {
            color:#333;
            margin:8px 0;
        }
        a.logout {
            display:inline-block;
            margin-top:20px;
            padding:10px 20px;
            background:#d9534f;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
        }
        a.logout:hover {
            background:#c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome <?= htmlspecialchars($full_name) ?> 🎉</h1>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p>You are successfully logged in to your profile dashboard.</p>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
