<?php
include('../includes/connect.php');
if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    
    // Fetch product details from the database
    $select_query = "SELECT * FROM `products` WHERE product_id = '$product_id'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    
    // Check if product details are fetched successfully
    if($row_fetch) {
        // Assign fetched product details to variables
        $product_title = $row_fetch['product_title'];
        $product_description = $row_fetch['product_description'];
        $product_keywords = $row_fetch['product_keywords'];
        $category_id = $row_fetch['category_id'];
        $product_price = $row_fetch['product_price'];
        $product_image=$row_fetch['product_image1'];
        
// Add more variables if needed

        if(isset($_POST['edit_btn'])){
            $product_image1=$_FILES['product_image1']['name'];
            $temp_image1=$_FILES['product_image1']['tmp_name'];
            $image_destination = "./product_img/$product_image1";
            echo $image_destination;
            // Retrieve updated product details from the form
            move_uploaded_file($temp_image1,"./product_img/$product_image1");
            
            $updated_product_title = $_POST['product_title'];
            $updated_product_description = $_POST['product_description'];
            $updated_product_keywords = $_POST['product_keywords'];
            $updated_category_id = $_POST['category_id'];
            $updated_product_price = $_POST['product_price'];
            // Retrieve additional updated fields if needed

            // Update product details in the database
            $update_query = "UPDATE products SET 
                product_title='$updated_product_title', 
                product_description='$updated_product_description', 
                product_keywords='$updated_product_keywords', 
                category_id='$updated_category_id', 
                product_image1='$product_image1' ,
                product_price='$updated_product_price' 
                WHERE product_id='$product_id'";
            $result_queryup = mysqli_query($con, $update_query);

            if($result_queryup){
                echo "<script>alert('Product Data Updated Successfully')</script>";
                echo "<script>window.location.href = 'index.php';</script>"; // Redirect to index page
            
            } else {
                echo "<script>alert('Failed to Update Product Data')</script>";
            }
        }
    } else {
        echo "<script>alert('Product not found')</script>";
    }
} else {
    echo "<script>alert('Product ID not provided')</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn-submit {
            display: block;
            width: 50%; /* Adjust button width as needed */
            margin: 0 auto; /* Center the button horizontally */
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .product-image {
        width: 200px; /* Adjust width as needed */
        height: auto; /* Automatically adjust height to maintain aspect ratio */
        display: block; /* Ensure image is displayed as a block element */
        margin-bottom: 10px; /* Add some bottom margin for spacing */
    }
    </style>
</head>
<body>
    <div class="container">
        <h3>Edit Product</h3>
          <!-- HTML form fields with PHP variables -->
            <form action="" method="post" enctype="multipart/form-data" class="w-50 mx-auto">
        <!-- Product Title -->
        <div class="form-group m-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" name="product_title" placeholder="Product Title" value="<?php echo isset($product_title) ? $product_title : '' ?>">
        </div>        

        <!-- Product Image -->
        <div class="form-group m-4">
                <label for="product_image1" class="form-label">Current Product Image</label><br>
                <?php if(isset($product_image) && !empty($product_image)) { ?>
                    <img src="./product_img/<?php echo $product_image; ?>" alt="Product Image" class="product-image"><br>
                <?php } ?>
                <label for="product_image1" class="form-label">Upload New Product Image</label>
                <input type="file" name="product_image1" id="product_image" class="form-control">
            </div> 

        <br>
        <!-- Product Description -->
        <div class="form-group m-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" class="form-control" name="product_description" placeholder="Product Description" value="<?php echo isset($product_description) ? $product_description : '' ?>">
        </div>

        <!-- Product Keywords -->
        <div class="form-group mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" class="form-control" name="product_keywords" placeholder="Product Keywords" value="<?php echo isset($product_keywords) ? $product_keywords : '' ?>">
        </div>

        <!-- Category ID -->
        <div class="form-group mb-4">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-control" name="category_id">
        <?php
        // Fetch categories from the categories table
        $category_query = "SELECT * FROM categories";
        $category_result = mysqli_query($con, $category_query);

        // Check if categories are fetched successfully
        if ($category_result && mysqli_num_rows($category_result) > 0) {
            while ($category_row = mysqli_fetch_assoc($category_result)) {
                $category_title = $category_row['category_title'];
                $category_id = $category_row['category_id'];
                // Check if the current category is the selected category
                $selected = ($category_id == $category_id) ? 'selected' : '';
                echo "<option value='$category_id' $selected>$category_title</option>";
            }
        }
        ?>
    </select>
</div>



        <!-- Product Price -->
        <div class="form-group mb-4">
            <label for="product_price" class="form-label">Product Price</label>    
            <input type="text" class="form-control" name="product_price" placeholder="Product Price" value="<?php echo isset($product_price) ? $product_price : '' ?>">
        </div>
            <!-- Add more form fields for additional product details if needed -->

            <button type="submit" class="btn-submit" name="edit_btn">Submit</button>
        </form>
    </div>
</body>
</html>
