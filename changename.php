<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];

    // Controleer of de gebruikersnaam minimaal 4 karakters lang is
    if (strlen($user_name) >= 4) {
        // Voeg de gebruikersnaam toe aan de sessie
        $_SESSION['user_name'] = $user_name;

        // Controleer of de gebruikersnaam al in gebruik is
        global $con;
        include("PHP/connect.php");

        $check_query = "SELECT * FROM users WHERE user_name='$user_name'";
        $result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($result) == 0) {
            // Update de gebruikersnaam in de database
            $added_user_id = $_SESSION['added_user_id']; // Haal de gebruikers-ID op uit de sessie
            $update_query = "UPDATE users SET user_name='$user_name' WHERE id='$added_user_id'";
            mysqli_query($con, $update_query);

            // Redirect naar de inlogpagina
            header("Location: login.php");
            die;
        } else {
            echo "Deze gebruikersnaam is al in gebruik. Kies een andere.";
        }
    } else {
        echo "Ongeldige gebruikersnaam. De gebruikersnaam moet minimaal 4 karakters bevatten.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Email Check</title>

    <link rel="stylesheet" href="assets/styles/formStyles.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <form method="POST">
        <h3>How can we call you?</h3>
        <label for="user_name">Enter New User Name:</label>
        <input type="text" id="user_name" name="user_name">
        <input type="submit" value="Submit" id="button">
    </form>
</div>
</body>
</html>

<input type="text" name="code" class="form-style" placeholder="Your Code" id="logemail" autocomplete="off">
<i class="input-icon uil uil-at"></i>
</div>
<label for="user_name">Enter New User Name:</label>
<input type="text" id="user_name" name="user_name">
<input type="submit" value="Submit">
