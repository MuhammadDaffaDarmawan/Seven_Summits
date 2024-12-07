<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "../conn.php";

$username = $_SESSION['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare the SQL update statement
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = $conn->prepare("UPDATE user SET email = :email, password = :password WHERE username = :username");
    $query->bindParam(':password', $hashed_password);
} else {
    $query = $conn->prepare("UPDATE user SET email = :email WHERE username = :username");
}
$query->bindParam(':email', $email);
$query->bindParam(':username', $username);

if ($query->execute()) {
    header("Location: profile.php?success=1");
} else {
    header("Location: profile.php?error=1");
}
?>