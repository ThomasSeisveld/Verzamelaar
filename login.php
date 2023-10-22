<?php
session_start();
global $con;
include("PHP/connect.php");
include("PHP/functions.php");

if (isset($_SESSION["clogged"]) && $_SESSION["clogged"] === true) {
    header("Location: Index.php");
    die;
}

if (isset($_POST['submit+'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
//    $remember = $_POST['Rememberme'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 1) {
        $user_data = mysqli_fetch_assoc($result);
        $hash = password_hash($user_data['password'], PASSWORD_DEFAULT);;
        if (password_verify($password, $hash)) {
            $_SESSION["clogged"] = true;
            $_SESSION["username"] = $user_data['user_name'];
            $_SESSION["id"] = $user_data['id'];
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $user_data['role'];
//            if ($remember == 'on') {
//                setcookie("email", $email, time() + (86400 * 30), "/");
//                setcookie("password", $password, time() + (86400 * 30), "/");
//            }

            header("location: Index.php");
            die;
        }

    }

    echo '<script>alert("Gebruikersnaam of wachtwoord is onjuist")</script>';
}
//
//if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
//    $email = $_COOKIE['email'];
//    $password = $_COOKIE['password'];
//    $query = "SELECT * FROM users WHERE email='$email'";
//    $result = mysqli_query($con, $query);
//
//    if ($result && mysqli_num_rows($result) == 1) {
//        $user_data = mysqli_fetch_assoc($result);
//
//        if (password_verify($password, $user_data['password'])) {
//            $_SESSION["clogged"] = true;
//            $_SESSION["username"] = $user_data['user_name'];
//            $_SESSION["id"] = $user_data['id'];
//
//            header("location: Index.php");
//            die;
//        }
//    }
//}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Collections CSGO</title>
    <link rel="icon" href="" type="image/icon type">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/styles/formStyles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-login-form.min.css" />
</head>
<body>
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <form method="POST">
        <h3>Login Here</h3>

        <label for="email">Email</label>
        <input type="text" placeholder="Email" name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="Rememberme">
            <small>Remember Me</small>
        </label>
        <input type="submit" value="Login" name="submit+" id="button">
        <div class="social">
            <div class="go"><i class="fab fa-google"></i>  Google</div>
            <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
        <div class="textdiv"><p>Do not have a account? <a href="signup.php">SIGNUP Here</a></p></div>
    </form>
</div>
</body>
</html>