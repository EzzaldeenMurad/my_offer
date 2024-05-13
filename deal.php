<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deals Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .deal-card {
        display: flex;
        width: 100%;
        gap: 50px;
    }

    .deal-card img {
        width: 30% !important;
        height: 200px;
    }

    input {
        width: 50%;
        padding: 15px;
        margin: 5px 0 22px 0;
        /* display: inline-block; */
        border: none;
        background: #d9d7d7;
        text-align: center !important;
    }

    button {
        background-color: #0070f9;
        color: white;
        padding: 14px 20px;
        margin: 8px 0px;
        border: none;
        cursor: pointer;
        width: 20%;
        /* opacity: 0.9; */
        text-align: left !important;
    }
</style>

<body>

    <img src="photo/Logo.jpg" height="60px" , width="90px">

    <ul>
        <li><a class="active" href="home.php">Home</a></li>
        <?php
        include 'conn_db.php';

        $sqlCat = "SELECT * FROM  category";
        $resultCat = $conn->query($sqlCat);
        if ($resultCat->num_rows > 0) {
            // Loop through each row of data
            while ($rowCat = $resultCat->fetch_assoc()) {
        ?>
                <li><a href="home.php?cat_id=<?= $rowCat["id"] ?>"><?= $rowCat["title"] ?></a></li>
        <?php
            }
        }
        ?>
    </ul>
    <?php
    $sqlGetOffer = "SELECT * FROM offer WHERE id=" . $_GET["id"];
    $resultGetOffer = $conn->query($sqlGetOffer);
    $rowGetOffer = $resultGetOffer->fetch_assoc();
    ?>
    <div class="div" style="padding: 20px;">Home > <?= $_GET["id"] ?> > <?= $rowGetOffer['title'] ?></div>

    <!---->
    <div class="">
        <!-- Deal Card 1 -->
        <?php
        $sql = "SELECT * FROM offer WHERE id = " . $_GET["id"];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $dealPrice = $row['org_price'] - ($row['org_price'] * $row['discount'] / 100);
        ?>
                <div class="deal-card">
                    <img src="photo/<?= $row['image']; ?>" alt="Car Tinting" class="deal-image">
                    <div class="deal-info">
                        <h3><?= $row['title']; ?></h3>
                        <p><?= $row['description']; ?></p>
                        <p>Dicount: <?= $row['discount']; ?> %</p>
                        <p>Orginal Price: SAR <?= $row['org_price']; ?></p>
                        <!-- <p>Price: <?= $dealPrice ?></p> -->
                        <p class="deal-price">Price: SAR <?= $dealPrice; ?></p>
                        <form method="post" action="proccess_deal.php">
                            <div>
                                <button type="button" class="decrement" disabled>-</button>
                                <input type="hidden" name="offer_id" value="<?= $row['id']; ?>">
                                <input style=" width: 20%;" type="text" name="quantity" class="quantity-input" value="1" readonly>
                                <button  type="button" class="increment">+</button>
                            </div>
                            <button type="submit" name="add_to_cart" style=" width: 50%;">Add to cart</button>
                        </form>
                    </div>
                </div>
        <?php }
        }
        ?>

    </div>

    <script>
        // Get the quantity input field and buttons
        const quantityInput = document.querySelector('.quantity-input');
        const incrementButton = document.querySelector('.increment');
        const decrementButton = document.querySelector('.decrement');
        const addToCartButton = document.querySelector('button[name="add_to_cart"]');

        // Increment quantity
        incrementButton.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            quantity += 1;
            quantityInput.value = quantity;
            decrementButton.disabled = false;
        });

        // Decrement quantity
        decrementButton.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity -= 1;
                quantityInput.value = quantity;
            }
            if (quantity === 1) {
                decrementButton.disabled = true;
            }
        });
    </script>

</body>

</html>