<?php
include 'register1.php';

 // Assuming you're getting the ID from the URL using GET

$sql = "SELECT * FROM product WHERE id = $id"; // Add semicolon and escape ID
$result = $conn->query($sql);

if ($result->num_rows > 0) { // Check if any results were found

  echo "<table border = \"1\">";

  while ($row = $result->fetch_assoc()) {
    $price = $row["org_price"] - $row["org_price"] * $row["discount"] / 100;

    echo "<tr>";
    echo "
        <td>
          <a href='prodect.php?id={$row["id"]}'>{$row["name"]}</a>
          <img src='images/{$row["image"]}'>  <p>{$row["description"]}</p>
          <p>SAR <del>{$row["org_price"]}</del>$price</p>
        </td>";
    echo "</tr>";
  }

  echo "</table>";

} else {
  echo "No product found with ID: $id"; // Handle no results case
}

?>