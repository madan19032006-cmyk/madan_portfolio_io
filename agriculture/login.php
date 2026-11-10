<?php
session_start();
require_once "db.php";

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Please enter username and password.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "SELECT id, username, password
             FROM users WHERE username = ? LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);

            $_SESSION["user_id"] = (int)$user["id"];
            $_SESSION["username"] = $user["username"];

            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - AgriCare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

<div class="login-card">
    <h1 align="center"> AgriCare</h1>
    <h2 align="center">Admin Login</h2>
    <p align="center">Login to manage agriculture records.</p>

    <div align="center">
      <?php if ($error != "") { ?>
    </div>
    <div class="alert">
        <div align="center"><?php echo htmlspecialchars($error); ?>
          </div>
    </div>
    <div align="center">
      <?php } ?>
      
    </div>
    <form method="post" class="login-form">
        <label>
        <div align="center">Username
            <input type="text" name="username" required>
        </div>
        </label>

        <label>
        <div align="center">Password
            <input type="password" name="password" required>
        </div>
        </label>

        <div align="center">
          <button type="submit" class="btn">
            Login
          </button>
        </div>
    </form>
</div>

</body>
</html>