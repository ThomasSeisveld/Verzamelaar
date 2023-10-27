<?php
session_start();
global $con;
include("PHP/connect.php");

$id = $_GET['id'];
$user_name = $_SESSION["username"];
$result = $con->query("SELECT * FROM items WHERE id = '$id'");
$row = $result->fetch_array();

$user = $row['user'];
$id = $row['id'];
$itemName = $row['itemName'];
$type = $row['type'];
$skin = $row['skin'];
$rarity = $row['rarity'];
$price = $row['price'];
$picture = $row['picture'];

$result = $con->query("SELECT * FROM users WHERE user_name = '$user'");
$row = $result->fetch_array();

$email = $row['email'];


if (isset($_POST['submit'])) {
    $itemName = $row['itemName'];
    $price = $_POST['price'];
    $message = $_POST['message'];
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO orders (itemName, price, message, date) VALUES ('$itemName', '$price', '$message', '$date')";
    mysqli_query($con, $query);
    if (!empty($itemName) && !empty($price)) {

        $to = $email;
        $subject = "New bid";
        $message = "
this is a no-reply email...
There is a new bid on $itemName by $user_name

Price:
$price
";
        $headers = "From: Collections CSGO";
        mail($to, $subject, $message, $headers);
        die;
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

    <title>Bieden</title>

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
        <div class="card h-100">
            <img class="card-img-top" src="assets/images/posts/<?php echo $picture; ?>" alt="..." />
        </div>
        <br>
        <div class="text-center">
            <h5 class="fw-bolder"><?php echo $itemName; ?><p class="fw-light"><?php echo $skin; ?></p></h5>
            <p>Price: $<?php echo $price; ?></p>
            <!--                                <p>Owner: --><?php //echo $user; ?><!--</p>-->
        </div>
        <h3>Bid System</h3>
        <input type="number" name="price" class="form-style" placeholder="Your Price" id="price" autocomplete="off">
        <input type="text" name="message" class="form-style" placeholder="message to <?php echo $user; ?>" id="message">
        <input type="submit" value="submit" name="submit" id="button">
    </form>
</div>
</body>
</html>
