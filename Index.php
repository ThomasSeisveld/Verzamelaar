<?php
session_start();
global $con;
include("PHP/connect.php");
include("PHP/functions.php");
$user_name = $_SESSION["username"];
$category = isset($_GET['category']) ? $_GET['category'] : 'recent';
// Standaard query voor recente items
$query = "SELECT * FROM items ORDER BY date DESC, id DESC LIMIT 7";
// Als een specifieke categorie is geselecteerd, pas de query aan
switch ($category) {
    case 'knifes':
        $query = "SELECT * FROM items WHERE type = 'knifes' ORDER BY date DESC, id DESC";
        break;
    case 'weapons':
        $query = "SELECT * FROM items WHERE type = 'weapons' ORDER BY date DESC, id DESC";
        break;
    case 'gloves':
        $query = "SELECT * FROM items WHERE type = 'gloves' ORDER BY date DESC, id DESC";
        break;
    case 'agents':
        $query = "SELECT * FROM items WHERE type = 'agents' ORDER BY date DESC, id DESC";
        break;
    case 'all':
        $query = "SELECT * FROM items";
        break;
    default:
        // Voor het geval er een onbekende categorie is geselecteerd
        break;
}

$result = mysqli_query($con, $query);
$rows = [];

while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}






//andere methode:
//session_start();
//global $con;
//include("PHP/connect.php");
//include("PHP/functions.php");
//$user_name = $_SESSION["username"];
//$category = isset($_GET['category']) ? $_GET['category'] : 'recent';
//
//// Definieer de standaard sorteeropties
//$sortOption = "date";
//$sortOrder = "DESC";
//
//// Als er een sorteeroptie is opgegeven via de URL, gebruik deze
//if(isset($_GET['sort'])) {
//    $sortOption = $_GET['sort'];
//}
//
//// Als er een sorteerorde is opgegeven via de URL, gebruik deze
//if(isset($_GET['order'])) {
//    $sortOrder = $_GET['order'];
//}
//
//// Maak de query met variabelen
//$query = "SELECT * FROM items";
//if($category !== 'all') {
//    $query .= " WHERE type = '$category'";
//}
//$query .= " ORDER BY $sortOption $sortOrder, id DESC";
//
//$result = mysqli_query($con, $query);
//$rows = [];
//
//while ($row = mysqli_fetch_assoc($result)) {
//    $rows[] = $row;
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSGO LibrarMarkts</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CSGO LibrarMarkts</a>
    <button class="navbar-toggler Midden" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="notCreated.php">Collectors</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Items
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="Index.php?category=knifes">Knives</a>
                    <a class="dropdown-item" href="Index.php?category=weapons">Weapons</a>
                    <a class="dropdown-item" href="Index.php?category=gloves">Gloves</a>
                    <a class="dropdown-item" href="Index.php?category=agents">Agents</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="Index.php?category=all">All items</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav Rechts">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="notCreated.php">Account</a>
                    <a class="dropdown-item" href="notCreated.php">Inventory</a>
                    <a class="dropdown-item" href="addItem.php">Add Items</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="PHP/Logout.php">Uitloggen</a>
                </div>
            </li>
        </ul>

    </div>
</nav>
<header class="bg-primary py-5 mooizo">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">CSGO LibrarMarkts</h1>
            <p class="lead fw-normal text-white-50 mb-0">Collectors</p>
        </div>
    </div>
</header>
<!-- Section-->

<section class="py-5 bg-dark" >
<!--    <div class="container mt-4 text-center">-->
<!--        <div class="row">-->
<!--            <div class="col-md-4">-->
<!--                <label for="sortOptions" class="form-label">Sorteer op:</label>-->
<!--                <select class="form-select" id="sortOptions">-->
<!--                    <option value="Filter">Tijd</option>-->
<!--                    <option value="date">Datum</option>-->
<!--                    <option value="price">Prijs</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            foreach ($rows as $row) {
                $user = $row['user'];
                $id = $row['id'];
                $itemName = $row['itemName'];
                $type = $row['type'];
                $skin = $row['skin'];
                $rarity = $row['rarity'];
                $price = $row['price'];
                $picture = $row['picture'];
                ?>

                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="assets/images/posts/<?php echo $picture; ?>" alt="..." />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?php echo $itemName; ?><p class="fw-light"><?php echo $skin; ?></p></h5>
                                <p>Price: $<?php echo $price; ?></p>
                                <!--                                <p>Owner: --><?php //echo $user; ?><!--</p>-->
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#" onclick="openModal('<?php echo $itemName; ?>', '<?php echo $skin; ?>', '<?php echo $type; ?>', '<?php echo $rarity; ?>', '<?php echo $price; ?>', '<?php echo $user; ?>')">View options</a></div>
                            <br>
                            <div class="text-center">
                                <a href="bieden.php?id=<?php echo $id?>"><button class="btn btn-outline-dark mt-auto">Purchase</button></a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Item Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Voeg hier de details van het item toe -->
                    <!-- Voorbeeld: -->
                    <h2 id="modalItemName"></h2>
                    <p id="modalSkin"></p>
                    <p id="modalType"></p>
                    <p id="modalRarity"></p>
                    <p id="modalPrice"></p>
                    <p id="modalUser"></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<div class="footer bg-dark">-->
<!--    <hr class="hr-top">-->
<!--    <img src="img/logo.png" id="logo-footer" alt="logo">-->
<!--    <div class="footer-text">-->
<!--        <a href="privacy.php?id=conditions">Conditions</a>-->
<!--        <a href="privacy.php?id=cookies">Cookies</a>-->
<!--        <a href="privacy.php?id=privacy">Privacy</a>-->
<!--        <a href="contact.html">Contact</a>-->
<!--    </div>-->
<!---->
<!--    <hr class="hr-bottom">-->
<!--</div>-->
<script>
    function openModal(itemName, skin, type,  rarity, price, user) {

        document.getElementById('modalItemName').textContent = itemName;
        document.getElementById('modalSkin').textContent = 'Skin: ' + skin;
        document.getElementById('modalType').textContent = 'Type: ' + type;
        document.getElementById('modalRarity').textContent = 'Rarity: ' + rarity;
        document.getElementById('modalPrice').textContent = 'Price: $' + price;
        document.getElementById('modalUser').textContent = 'Owner: ' + user;

        var myModal = new bootstrap.Modal(document.getElementById('itemModal'));
        myModal.show();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>
