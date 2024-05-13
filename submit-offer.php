<?php
include 'conn_db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $conn->prepare("INSERT INTO offer (title, image, description, org_price, discount, cat_id, user_id, quantity, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $title = $_POST['title'];
        $description = $_POST['description'];
        $org_price = $_POST['originalPrice'];
        $discount = $_POST['discount'];
        $quantity = $_POST['quantity'];
        $cat_id = $_POST['category'];

        if (isset($_SESSION['user_id'])) {
            $user_id  = $_SESSION['user_id'];
            if (!empty($_FILES["image"]["name"])) {
                $targetFile =  basename($_FILES["image"]["name"]);

                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $targetFile);
                    $image =  $targetFile;
                    $stmt->execute([$title, $image, $description, $org_price, $discount, $cat_id, $user_id, $quantity]);
                    echo "<script>alert('Offer Added Successfully.')
                    window.location.href = 'index.php';
                    </script>";
                } else {
                    echo "<script>alert('File is not an image.')
                    window.location.href = 'submit-offer.php';
                    </script>";
                }
            } else {
                echo "<script>alert('Please select an image.');
                window.location.href = 'submit-offer.php';
                </script>";
            }
        } else {
            echo "<script>alert('Please login first.');
            window.location.href = 'submit-offer.php'; </script>";
        }
    } catch (PDOException $e) {
        echo "<center>Error: " . $e->getMessage() . "</center>";
    }
} else {
    echo "";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css./form.css">
    <title>sumit Offer</title>
</head>

<body>
    <div class="container">
        <h2></h2>
        <form action="submit-offer.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Offer Title:</label>
                <input type="text" name="title" id="title" placeholder="Offer Title here.." required>
            </div>
            <div class="form-group">
                <label for="category">Offer Category:</label>
                <select name="category" id="category">
                    <?php
                    include 'conn_db.php';
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value=" <?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                        <li><a href="index.php?cat_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></li>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="originalPrice">Original Price:</label>
                <input type="text" name="originalPrice" placeholder="Original Price here.." required>
            </div>
            <div class="form-group">
                <label for="discount">Discount:</label>
                <input type="text" name="discount" placeholder=" Discount here.." required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" placeholder=" Quantity here.." required>
            </div>
            <d iv class="form-group">
                <label class="upload-image" for="image">Offer Image</label>
                <input class="upload-image" type="file" name="image" placeholder="" accept="image/*">
            </d>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" required placeholder="Description here.."></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Upload">
            </div>
        </form>
    </div>
</body>

</html>