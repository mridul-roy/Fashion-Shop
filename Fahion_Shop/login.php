<?php
require 'logo.php';
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM userdata WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['email'] = $email;
            header("Location: products.php");
            exit();
        } else {
            $error = "Invalid Email or Password";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <br>
    <button onclick="window.location.href='index.php';">
        Home
    </button>
    <button onclick="window.location.href='products.php';">
        Products
    </button>
    <button onclick="window.location.href='cont.php';">
        Contact Us
    </button>
    <button onclick="window.location.href='about.php';">
        About Us
    </button>

    <title>Gadgets Ache | Products</title>
</head>
<body>
<header>
    <?php require 'logo.php'; ?>

    <fieldset>
        <form action="login.php" method="post">
            <label for="email"><b>E-Mail</b></label>
            <input type="text" placeholder="Enter Email" name="email" required><br>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required><br>
            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </form>
        <?php if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        } ?>
    </fieldset>
</header>
</body>
</html>
