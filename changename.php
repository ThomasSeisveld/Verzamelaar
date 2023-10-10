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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Name</title>
</head>
<body>
<form action="" method="post">
    <label for="user_name">Enter New User Name:</label>
    <input type="text" id="user_name" name="user_name">
    <input type="submit" value="Submit">
</form>
</body>
</html>

