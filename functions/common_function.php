<?php

$con = mysqli_connect('localhost','root','','mystore');
if(!$con){
    die(mysqli_error($con));
}

function getproducts(){
    global $con;
    if(!isset($_GET['category'])){
        $select_query="Select * from products order by rand() limit 0,9";
        $result_query= mysqli_query($con,$select_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];
            $category_id=$row['category_id'];
                    
            echo "
            <div class='col-md-4 md-2'>
                <div class='card'>
                    <img src='./adminarea/product_img/" . $product_image1 . "' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $product_title . "</h5>
                        <p class='card-text'>" . $product_description . "</p>
                        <a name='add_to_cart' href='index.php?product_id=" . $product_id . "' class='btn btn-primary' onclick='reloadPage()'>Add to cart</a>
                        <a href='product_details.php?product_id=" . $product_id . "' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
        }
    }
}

function get_unique_categories(){
    global $con;
    if(isset($_GET['category'])){
        
        $category_id=$_GET['category'];
        $select_query="Select * from products where category_id=$category_id";
        $result_query= mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h3 class='text-center'>No stock present in this category</h3>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];
            $category_id=$row['category_id'];
                    
            echo "
            <div class='col-md-4 md-2'>
                <div class='card'>
                    <img src='./adminarea/product_img/$product_image1' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <a name='add_to_cart' href='index.php?product_id=echo $product_id;' class='btn btn-primary' onclick='reloadPage()'>Add to cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>                    </div>
                </div>
            </div>";
        }
    }
}


    
    function getcategories(){
        global $con;
        
            
        $select_cat="select * from categories";
            $result_cat=mysqli_query($con,$select_cat);
            while($row_data=mysqli_fetch_assoc($result_cat)){
                $cat_title=$row_data['category_title'];
                $cat_id=$row_data['category_id'];
                echo "<li class='nav-item '>
                <a href='index.php?category=$cat_id' class='nav-link text-light'>$cat_title</a>
            </li>";
            }
        
    }

    function search_product(){
        global $con;
    
        if(isset($_GET['search_data_product'])){
            $search_data_value=$_GET['search_data'];
    $search_query="Select * from products where product_keywords like '%$search_data_value%'";
                $result_query= mysqli_query($con,$search_query);
                $num_of_rows=mysqli_num_rows($result_query);
                if($num_of_rows==0){
                echo "<h3 class='text-center'>No Match Found</h3>";
                }
                while($row=mysqli_fetch_assoc($result_query)){
                    $product_id=$row['product_id'];
                    $product_title=$row['product_title'];
                    $product_description=$row['product_description'];
                    $product_image1=$row['product_image1'];
                    $product_price=$row['product_price'];
                    $category_id=$row['category_id'];
                    
                    echo "
            <div class='col-md-4 md-2'>
                <div class='card'>
                    <img src='./adminarea/product_img/$product_image1' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <a name='add_to_cart' href='index.php?product_id=echo $product_id;' class='btn btn-primary' onclick='reloadPage()'>Add to cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>                    </div>
                </div>
            </div>";
                }
            }
        }

        function get_all_products(){
            global $con;
    if(!isset($_GET['category'])){

    $select_query="Select * from products order by rand()";
                $result_query= mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $product_id=$row['product_id'];
                    $product_title=$row['product_title'];
                    $product_description=$row['product_description'];
                    $product_image1=$row['product_image1'];
                    $product_price=$row['product_price'];
                    $category_id=$row['category_id'];
                    
                    echo "
            <div class='col-md-4 md-2'>
                <div class='card'>
                    <img src='./adminarea/product_img/$product_image1' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <a name='add_to_cart' href='index.php?product_id=echo $product_id;' class='btn btn-primary' onclick='reloadPage()'>Add to cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>  </div>
                </div>
            </div>";
                }
            }
        }

        function view_details(){
            global $con;
            if(isset($_GET['product_id'])){
            if(!isset($_GET['category'])){
                $product_id=$_GET['product_id'];

        
            $select_query="Select * from products where product_id=$product_id";
                        $result_query= mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $product_id=$row['product_id'];
                            $product_title=$row['product_title'];
                            $product_description=$row['product_description'];
                            $product_image1=$row['product_image1'];
                            $product_price=$row['product_price'];
                            $category_id=$row['category_id'];
                            
                            echo "
                            <div class='col-md-4 md-2'>
            
                            <div class='card'>
                                <img src='./adminarea/product_img/$product_image1' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-8 md-2 p-3'>
                                    <p class='card-text'>$product_description</p>
                                    
                                    <a name='add_to_cart' href='index.php?product_id=echo $product_id;' class='btn btn-primary' onclick='reloadPage()'>Add to cart</a>
                                    <a href='index.php' class='btn btn-secondary'>Back Home</a>
                        </div>";
                        }
                    }
                
        }
    }
    
    //cart function
    function cart(){
        
        if(isset($_GET['product_id'])) {
            //$product_id = urldecode($_GET['product_id']);
            //echo $product_id;
            preg_match('/\d+/', $_GET['product_id'], $matches);
            $product_id = isset($matches[0]) ? (int)$matches[0] : 0;

            global $con;
            if(!isset($_SESSION['username'])){
                echo "<script>alert('Please log in to add items to your cart')</script>";
                echo "<script> window.location.href = 'user_area/user_login.php';</script>";
                       
            }
            else{
                $username = $_SESSION['username']; // Retrieve the user_id from the session
                
                $select_query = "SELECT * FROM user_table WHERE username = '$username'";
                $result_query = mysqli_query($con, $select_query);
                $row = mysqli_fetch_assoc($result_query);                
                $user_id=$row['user_id'];
                // Check if the item is already in the user's cart
                $select_query = "SELECT * FROM cart_details WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $result_query = mysqli_query($con, $select_query);
                $num_of_rows = mysqli_num_rows($result_query);
                
                if($num_of_rows > 0){
                    // Item is already in the cart, display an alert
                    echo "<script>alert('This item is already present inside cart')</script>";
                    echo "<script>window.open('cart.php','_self')</script>";
                } else {
                    // Item is not in the cart, insert it
                    
                    $insert_query = "INSERT INTO cart_details (user_id, product_id, quantity) VALUES ('$user_id','$product_id', 1)";

                    $result_query = mysqli_query($con, $insert_query);
                    
                    if($result_query){
                        // Item added successfully
                        echo "<script>alert('Item is added to cart'); </script>";
                        echo "<script> window.location.href = document.referrer;</script>";
                        
                    } else {
                        // Error inserting item
                        echo "<script>alert('Failed to add item to cart'); </script>";
                    }
                }
            }
        }
        
    }
    function calculateTotalPrice() {
        global $con;
        $totalPrice = 0;
        $username = $_SESSION['username'];
        
        // Retrieve user ID
        $selectUserQuery = "SELECT user_id FROM user_table WHERE username='$username'";
        $resultUser = mysqli_query($con, $selectUserQuery);
        $rowUser = mysqli_fetch_assoc($resultUser);
        $userId = $rowUser['user_id'];
    
        // Retrieve cart items for the user
        $cartQuery = "SELECT * FROM cart_details WHERE user_id='$userId'";
        $resultCart = mysqli_query($con, $cartQuery);
    
        // Calculate total price
        while ($row = mysqli_fetch_assoc($resultCart)) {
            $productId = $row['product_id'];
            $quantity = $row['quantity'];
    
            // Retrieve product price
            $selectProductQuery = "SELECT product_price FROM products WHERE product_id='$productId'";
            $resultProduct = mysqli_query($con, $selectProductQuery);
            $rowProduct = mysqli_fetch_assoc($resultProduct);
            $productPrice = $rowProduct['product_price'];
    
            // Calculate subtotal for the product
            $subtotal = $productPrice * $quantity;
    
            // Add subtotal to total price
            $totalPrice += $subtotal;
        }
        return $totalPrice;
    }
    //function to get cart item numbers
    function cart_item(){
        if(isset($_SESSION['username'])){
            global $con;
            
            $user_username = $_SESSION['username'];
            $select_query = "SELECT * FROM user_table WHERE username='$user_username'";
            $result_query = mysqli_query($con, $select_query);
            $row = mysqli_fetch_assoc($result_query);
            $user_id = $row['user_id'];
    
            $select_cart_query = "SELECT * FROM cart_details WHERE user_id='$user_id'";
            $result_cart_query = mysqli_query($con, $select_cart_query);
            $count_cart_items = mysqli_num_rows($result_cart_query);
        } else {
            $count_cart_items = 0; // User is not logged in, so cart items count is zero
        }
        
        echo $count_cart_items;
    }
    
    

    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    // $ip = getIPAddress();  
    // echo 'User Real IP Address - '.$ip;  
    
    function get_user_order_details(){
        global $con;
        $username = $_SESSION['username'];
        $select_query = "SELECT * FROM user_table WHERE username='$username'";
        $result_query = mysqli_query($con, $select_query);
        
        while($row = mysqli_fetch_array($result_query)){
            $user_id = $row['user_id'];
            if(!isset($_GET['edit_account'])){
                if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['edit_account'])){
                        $get_orders = "SELECT * FROM user_orders WHERE user_id='$user_id'";
                        $result_orders_query = mysqli_query($con, $get_orders);
                        $row_count = mysqli_num_rows($result_orders_query);
                        if($row_count > 0){
                            echo "<h3 class='text-center'>You have <span class='text-danger'>$row_count</span> pending orders.</h3>";
                        }
                        else{
                            echo "<h3 class='text-center'>You have <span class='text-danger'>$row_count</span> pending orders.</h3>";
                        }
                    }
                }
            }
        }
    }
?>