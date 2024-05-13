<?php
include 'conn_db.php';
if (isset($_POST['add_to_cart'])) {
    $offerId = $_POST['offer_id'];
    $quantity = $_POST['quantity'];

    $offerQuantitySql = "SELECT quantity FROM offer WHERE id = $offerId";
    $offerQuantityResult = $conn->query($offerQuantitySql);

    if ($offerQuantityResult->num_rows > 0) {
        $offerData = $offerQuantityResult->fetch_assoc();
        $offerQuantity = $offerData['quantity'];

        if ($quantity <= $offerQuantity) {
            $newOfferQuantity = $offerQuantity - $quantity;
            $updateSql = "UPDATE offer SET quantity = $newOfferQuantity WHERE id = $offerId";
            $conn->query($updateSql);

            echo "<script>alert('Item added to cart successfully!')</script>";
            echo "<script>window.location.href='deal.php?id=" . $offerId . "'</script>";
        } else {
            echo "<script>alert('Insufficient quantity!')</script>";
            echo "<script>window.location.href = 'deal.php?id=" . $offerId . "'</script>";
        }
    } else {
        echo "<script>alert('Offer not found!')</script>";
    }
}
