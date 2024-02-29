<?php
// Check if product ID is provided in the URL
if(isset($_GET['id'])){
    $product_id = $_GET['id'];

    // Include database connection
    include('../includes/connect.php');

    // Perform deletion
    $delete_query = "DELETE FROM products WHERE product_id='$product_id'";
    $result_delete = mysqli_query($con, $delete_query);

    if($result_delete){
        echo "<script>alert('Product Deleted Successfully')</script>";
        echo "<script>window.location.href = 'index.php';</script>"; // Redirect to index page
    } else {
        echo "<script>alert('Failed to Delete Product')</script>";
    }
} else {
    echo "<script>alert('Product ID not provided')</script>";
}
?>
