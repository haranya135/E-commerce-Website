<style>
/* Table styles */
.styled-table {
    width: 80%; /* Adjust table width as needed */
    margin: 0 auto; /* Center the table horizontally */
    border-collapse: collapse;
    border: 1px solid #ddd;
}

.styled-table th, .styled-table td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}

.styled-table th {
    background-color: #f2f2f2;
}

/* Button styles */
.btn-edit {
    display: inline-block;
    padding: 8px 16px;
    background-color: #28a745; /* Green */
    color: white;
    border: none;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
}

.btn-delete {
    display: inline-block;
    padding: 8px 16px;
    background-color: #dc3545; /* Red */
    color: white;
    border: none;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
}

/* Hover effect */
.btn-edit:hover, .btn-delete:hover {
    opacity: 0.8;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3 class="text-center">Categories</h3>
</body>
</html>
<?php
// Include database connection
include('../includes/connect.php');

// Query to fetch data from categories table
$select_query = "SELECT * FROM `categories`";
$result_query = mysqli_query($con, $select_query);

// Check if there are any categories
if(mysqli_num_rows($result_query) > 0) {
    // Start table with added classes for styling
    echo '<table class="styled-table">';
    // Table header
    echo '<tr>';
    echo '<th>Category ID</th>';
    echo '<th>Category Title</th>';
    echo '<th>Edit</th>';
    echo '<th>Delete</th>';
    echo '</tr>';

    // Loop through each row of data
    while($row_fetch = mysqli_fetch_assoc($result_query)) {
        // Display data in table rows
        echo '<tr>';
        echo '<td>' . $row_fetch['category_id'] . '</td>';
        echo '<td>' . $row_fetch['category_title'] . '</td>';
        echo '<td><a href="edit_category.php?id=' . $row_fetch['category_id'] . '" class="btn-edit">Edit</a></td>';
        echo '<td><a href="delete_cat.php?id=' . $row_fetch['category_id'] . '" class="btn-delete">Delete</a></td>';
        echo '</tr>';
    }

    // End table
    echo '</table>';
} else {
    // If no categories found, display a message
    echo 'No categories found.';
}


if(isset($_GET['edit_category'])){
    echo "Edit category is set!";
    include('edit_category.php');
}

?>

