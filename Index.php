<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<nav class="navbar"></nav>



<div class="container">
    <div class="main-info">
        <h2><b>Projects</b></h2>
        <br>
        <p>Made between (2021 - 2023)
            <br><br>

        </p>
    </div>
    <div class="flexbox">
        <?php
        include "PHP/connect.php";
        global $conn;
        $query = "SELECT name, Discription, Image FROM Images";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                ?>
                <div1>
                    <a href="gamedownload.php?id=game1"><img src="<?= $row["Image"]?>" alt="<?= $row["name"]?>" class="huis-img"></a>
                    <h4 class="huis" style="color: #2AA2D6;"><?=$row["name"]?></h4>
                    <p class="huis">2021</p>
                    <p class="huis"><b>Free - Download</b></p>
                </div1>
                <?php
            }
        }
        if (!$result) {
            die("Databasefout: " . mysqli_error($conn));
        }
        ?>
    </div>
</div>



<div class="footer">
    <hr class="hr-top">
    <img src="img/logo.png" id="logo-footer" alt="logo">
    <div class="footer-text">
        <a href="privacy.php?id=conditions">Conditions</a>
        <a href="privacy.php?id=cookies">Cookies</a>
        <a href="privacy.php?id=privacy">Privacy</a>
        <a href="contact.html">Contact</a>
    </div>

    <hr class="hr-bottom">
</div>
<script src="JS/Dev.js"></script>
</body>
</html>
