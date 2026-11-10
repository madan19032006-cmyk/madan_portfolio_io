<?php
require_once "db.php";

$username = "admin";
$password = "admin123";

$stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE username = ? LIMIT 1"
);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$existing = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($existing) {
    echo "Admin account already exists.";
} else {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO users (username, password) VALUES (?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "ss", $username, $hash);

    if (mysqli_stmt_execute($stmt)) {
        echo "Admin created successfully.<br>";
        echo "Username: admin<br>";
        echo "Password: admin123<br>";
        echo "Delete create_admin.php now.";
    } else {
        echo "Error creating admin: " .
             htmlspecialchars(mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
}
?>