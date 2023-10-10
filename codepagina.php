<?php
session_start();
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

        // Redirect to login page
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

    <!-- Icon Logo -->

    <link rel="icon" href="../afbeeldingen/logo.png">

    <title>Email Check</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <label for="reg-log"></label>
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <form method="POST">
                                            <h4 class="mb-4 pb-3" style="color: white">Email Check</h4>
                                            <div class="form-group">
                                                <input type="text" name="code" class="form-style" placeholder="Your Code" id="logemail" autocomplete="off">
                                                <i class="input-icon uil uil-at"></i>
                                            </div>
                                            <input type="submit" value="submit" name="submit" class="btn mt-4">
                                            <p class="mb-0 mt-4 text-center" style="color: white">You got a mail with a 4 diget code please enter that code here!</p>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

