<?php
session_start();

if (!isset($_SESSION['code'])) {
    header("Location: signup.php");
    die;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $entered_code = $_POST['code'];

    if ($entered_code == $_SESSION['code']) {
        // Code is correct, voeg gebruiker toe aan de database
        global $con;
        include("PHP/connect.php");

        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $role = $_SESSION['role'];
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (email, password, role, date) VALUES ('$email', '$password', '$role', '$date')";
        mysqli_query($con, $query);

        $added_user_id = mysqli_insert_id($con);
        // Save data in session
        $_SESSION['added_user_id'] = $added_user_id;
        $user_name = "user" . $added_user_id;

        $update_query = "UPDATE users SET user_name='$user_name' WHERE id='$added_user_id'";
        mysqli_query($con, $update_query);

        header("Location: changename.php");
        die;
    } else {
        echo "Incorrecte code. Probeer opnieuw.";
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
        <h3>Email Check</h3>
        <input type="text" name="code" class="form-style" placeholder="Your Code" id="logemail" autocomplete="off">

        <input type="submit" value="submit" name="submit" id="button">
    </form>
</div>
</body>
</html>

<input type="text" name="code" class="form-style" placeholder="Your Code" id="logemail" autocomplete="off">
<i class="input-icon uil uil-at"></i>
</div>