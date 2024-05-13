<?php

include 'register1.php'; // Assuming this file contains the database connection

// Category Information (if applicable)
$sql_category = "SELECT * FROM category"; // Adjust field name if needed
$result_category = $conn->query($sql_category);

if ($result_category->num_rows > 0) {
    while ($row_category = $result_category->fetch_assoc()) {
        echo "{$row_category["category_name"]} | "; // Replace with correct field name
    }
    echo "<br />"; // Add semicolon
}

// Product Information
$sql_product = "SELECT * FROM product";
$result_product = $conn->query($sql_product);

if ($result_product->num_rows > 0) {
    echo "<table border='1'>";

    while ($row_product = $result_product->fetch_assoc()) {
        $price = $row_product["org_price"] - $row_product["org_price"] * $row_product["discount"] / 100;

        echo "<tr>";
        echo "
            <td>
                <a href='prodect.php?id={$row_product["id"]}'>{$row_product["name"]}</a>
                <img src='images/{$row_product["image"]}'>
                <p>{$row_product["description"]}</p>
                <p>SAR <del>{$row_product["org_price"]}</del>$price</p>
            </td>";
        echo "</tr>";
    }

    echo "</table>";
}

?>
