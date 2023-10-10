<?php
session_start();
global $con;
include ("PHP/connect.php");
include ("PHP/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = strtolower($_POST['email']); // Converteer naar kleine letters
    $password = $_POST['password'];
    $role = 0;

    // Eerst controleren of het e-mailadres een geldig formaat heeft
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Controleren of het e-mailadres al in gebruik is
        $check_query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($result) == 0) {
            // Controleren of het wachtwoord minimaal 6 karakters heeft
            if (strlen($password) >= 6) {
                // Als het een geldig e-mailadres is en niet al in gebruik is, en het wachtwoord voldoet aan de eis, doorgaan met de rest van de validatie
                if (!empty($email) && !empty($password)) {
                    // Voeg de gebruiker toe aan de sessie
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['role'] = $role;

                    // Generate 4-digit code
                    $code = rand(1000, 9999);


                    // Send email
                    $to = $email;
                    $subject = "Welcome on board!";
                    $message = "
                    this is a no-reply email...
                    use code: $code to activate your account
                    
                    if these are not your actions PLEASE contact us!
                    email: 089560@gmail.com
                    
                    kind regards,
                    Collections CSGO
                    ";
                    $headers = "From: Collections CSGO";
                    mail($to, $subject, $message, $headers);

                    // Save data in session
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION["role"] = $role;
                    $_SESSION['code'] = $code;

                    // Redirect to code page
                    header("Location: codepagina.php");
                    die;
                } else {
                    echo "Invalid input";
                }
            } else {
                echo "Wachtwoord moet minimaal 6 karakters bevatten.";
            }
        } else {
            echo "Dit e-mailadres is al in gebruik.";
        }
    } else {
        echo "Ongeldig e-mailadres";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Collections CSGO</title>
    <link rel="icon" href="" type="image/icon type">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-login-form.min.css" />
    <style>
        body,h1
        {
            font-family: "Raleway", sans-serif
        }
        body, html
        {
            height: 100%
        }
        .bgimg
        {
            background-image: url('assets/images/login_request/wp2516222.jpg');
            min-height: 100%;
            background-position: center;
            background-size: cover;
        }
        .textdiv{
            padding: 10px;
            margin: 0;
        }
        form{
            height: 550px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
        }
        form *{
            font-family: 'Poppins',sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }
        form h3{
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label{
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }
        input{
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }
        ::placeholder{
            color: #e5e5e5;
        }
        button{
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        #button{
            margin-top: 30px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 10px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        .social{
            margin-top: 30px;
            display: flex;
        }
        .social div{
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255,255,255,0.27);
            color: #eaf0fb;
            text-align: center;
        }
        .social div:hover{
            background-color: rgba(255,255,255,0.47);
        }
        .social .fb{
            margin-left: 25px;
        }
        .social i{
            margin-right: 4px;
        }

    </style>
</head>
<body>
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <form method="post">
        <h3>Signup Here</h3>

        <label for="email">Email</label>
        <input type="text" placeholder="Email" name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password">

        <input type="submit" value="Login" id="button">
        <div class="social">
            <div class="go"><i class="fab fa-google"></i>  Google</div>
            <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
        <div class="textdiv"><p>Already have a account? <a href="login.php">Login Here</a></p></div>
    </form>
</div>
</body>
</html>