<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deals Website</title>
  <link rel="stylesheet" href="style.css">
</head>

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
        <!-- <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li> -->
    <?php
      }
    }
    ?>
  </ul>


  <!---->
  <div class="grid-container">
    <!-- Deal Card 1 -->
    <?php
    $sql = "";
    if (isset($_GET['cat_id'])) {
      $sql = "SELECT * FROM offer WHERE cat_id = " . $_GET["cat_id"] . " ORDER BY id DESC";
    } else if (isset($_GET['search'])) {
      $sql = "SELECT * FROM offer WHERE title LIKE '%" . $_GET["search"] . "%' ORDER BY id DESC";
    } else {
      $sql = "SELECT * FROM offer ORDER BY id DESC";
    }

    // Execute the query
    $result = $conn->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
      // Loop through each row of data
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
            <a href="deal.php?id=<?= $row['id']; ?>" class="view-deal">VIEW DEAL</a>
          </div>
        </div>
    <?php }
    }
    ?>

  </div>
</body>

</html>