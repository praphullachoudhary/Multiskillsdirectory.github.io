<?php
session_start();
include 'db.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE mobile = '$mobile'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("Location: directory.php");
        } else {
            $error = "Invalid Password";
        }
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><a href="index.php">Home</a></nav>
    <div class="form-container" style="background-color: #e3f2fd; border: 2px solid #2196F3;">
        <h2 style="color: #1565C0;">Login</h2>
        <p style="color:red;"><?php echo $error; ?></p>
        <form method="post">
            <input type="text" name="mobile" placeholder="Mobile Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn btn-need" style="width:100%">Login</button>
        </form>
        <p><a href="register.php">Create Account</a></p>
    </div>
</body>
</html>