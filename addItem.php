<?php
session_start();
global $con;
include ("PHP/connect.php");
include ("PHP/functions.php");
$user_name = $_SESSION["username"];

if(isset($_POST['submitItem'])) {
    $user = $_SESSION["username"];
    $ItemName = $_SESSION["ItemName"];
    $type = $_POST['type'];
    $skin = $_POST['skin'];
    $rarity = $_POST['rarity'];
    $price = $_POST['price'];
    $picture = $_FILES['picture']['name'];

        $query = "INSERT INTO items (ItemName, user, type, skin, rarity, price, picture) 
                  VALUES ('$ItemName', '$user', '$type', '$skin', '$rarity', '$price', '$picture')";

        if(mysqli_query($con, $query)) {
          echo "succes";
            header("location: Index.php");
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
    <link rel="stylesheet" href="assets/styles/inventStyles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-login-form.min.css" />
</head>
<body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');
        var ItemNameSelect = document.querySelector('[name="ItemName"]');
        var typeSelect = document.querySelector('[name="type"]');
        var skinInput = document.querySelector('[name="skin"]');
        var raritySelect = document.querySelector('[name="rarity"]');
        var priceInput = document.querySelector('[name="price"]');
        var pictureInput = document.querySelector('[name="picture"]');
        var submitButton = document.getElementById('button');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'knifes' || this.value === 'gloves') {
                raritySelect.value = "Gold";
                // raritySelect.disabled = true;
            }
            // else {
            //     raritySelect.disabled = false;
            // }
        });

        form.addEventListener('submit', function(event) {
            if (ItemNameSelect.value === '' || typeSelect.value === '' || skinInput.value === '' || raritySelect.value === '' || priceInput.value === '' || pictureInput.value === '') {
                alert("Vul alle velden in.");
                event.preventDefault(); // Voorkom dat het formulier wordt verzonden
            } else if (priceInput.value < 0 || priceInput.value > 1000000) {
                alert("De prijs moet tussen 0 en 1.000.000 liggen.");
                event.preventDefault(); // Voorkom dat het formulier wordt verzonden
            }
        });

        function checkInputs() {
            if (ItemNameSelect.value !== '' && typeSelect.value !== '' && skinInput.value !== '' && raritySelect.value !== '' && priceInput.value !== '' && pictureInput.value !== '') {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }
        ItemNameSelect.addEventListener('input', checkInputs);
        typeSelect.addEventListener('input', checkInputs);
        skinInput.addEventListener('input', checkInputs);
        raritySelect.addEventListener('input', checkInputs);
        priceInput.addEventListener('input', checkInputs);
        pictureInput.addEventListener('input', checkInputs);

        checkInputs(); // Controleer bij het laden van de pagina
    });
</script>

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <form method="POST">
        <label for="Item_Name">Name</label>
        <input type="text" placeholder="bijv.. AK" name="ItemName" required>
        <h3>Add to <?php echo $user_name; ?>'s inventory</h3>
        <label for="type">Type</label>
        <select class="select" name="type" required>
            <option value="">Selecteer een type</option>
            <option value="knifes">Knifes</option>
            <option value="gloves">Gloves</option>
            <option value="agents">Agents</option>
            <option value="weapons">Weapons</option>
        </select>

        <br>
        <label for="skin">Skin</label>
        <input type="text" placeholder="bijv.. Case hardened" name="skin" required>

        <label for="rarity">Rarity</label>
        <select class="select" name="rarity" required>
            <option value="">Selecteer een rarity</option>
            <option value="Gold">Gold</option>
            <option value="Covert">Covert</option>
            <option value="Classified">Classified</option>
            <option value="Restricted">Restricted</option>
            <option value="Mil-Spec">Mil-Spec</option>
        </select>
        <label for="price">Price</label>
        <input type="number" placeholder="Price" name="price" required>

        <label for="picture">Picture</label>
        <input type="file" accept="image/*" name="picture" required>

        <input type="submit" value="submit" name="submitItem" id="button">
    </form>
</div>

</body>
</html>