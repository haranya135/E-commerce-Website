<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view products</title>
</head>
<body>
    <h3 class="text-center">All Products</h3>
    
    <style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        background-color: #f0f0f0;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #e0e0e0;
    }
    .product-img {
        width: 75px;
        height: auto;
    }
    .product-title {
        width: calc(100% - 75px); /* 100% width minus the width of the image */
        display: inline-block;
        vertical-align: middle;
    }
    .edit-delete-buttons .edit-button {
        background-color: #4caf50;
        color: white;
    }
    .edit-delete-buttons .delete-button {
        background-color: #f44336;
        color: white;
    }
    .edit-delete-buttons button {
        border: none;
        padding: 6px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 2px;
        cursor: pointer;
        border-radius: 4px;
    }
    .edit-delete-buttons button:hover {
        opacity: 0.8;
    }
</style>
</head>
<body>

<?php
// Assuming you have already established a database connection

// Query to fetch data from the products table
$query = "SELECT product_id, product_title, product_image1, product_price, status FROM products";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Table header
    echo "<table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product</th>

                    <th>Product Price</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        
        echo "<tr>
        <td>" . $row["product_id"] . "</td>
        <td>
        <div class='card' style='width: 200px;'> <!-- Adjust width as needed -->
            <img src='./product_img/" . $row["product_image1"] . "' alt='" . $row["product_title"] . "' class='card-img-top' style='height: 200px; object-fit: cover;'> <!-- Adjust height as needed -->
            <div class='card-body'>
                <h5 class='card-title' >" . $row["product_title"] . "</h5> <!-- Adjust height and styling as needed -->
            </div>
        </div>
    </td>

        <td>" . $row["product_price"] . "/-</td>
        <td>";

// Assuming the 'status' field contains "true" or "false"
if ($row["status"] == "true") {
    echo "Available";
} else {
    echo "Not Available";
}

echo "</td>";


        echo '<td class="edit-delete-buttons"><a href="edit_product.php?id=' . $row["product_id"] . '"><button class="edit-button">Edit</button></a></td>';
echo '<td class="edit-delete-buttons"><a href="delete_product.php?id=' . $row["product_id"] . '"><button class="delete-button">Delete</button></a></td>';

    }

    echo "</tbody></table>";
} else {
    echo "0 results";
}

// Close the database connection

?>

</body>
</html>