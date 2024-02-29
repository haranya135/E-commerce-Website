<?php
include('.\includes\connect.php');
include('..\functions\common_function.php');

session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    /* Custom styles */
    /* Navbar */
    .navbar {
        background-color: #343a40 !important; /* Dark color1 */
    }

    .navbar-brand img {
        height: 50px; /* Adjust logo height */
        width: auto;
    }

    .navbar-nav .nav-link {
        color: #ffffff !important; /* White color5 */
    }

    .navbar-nav .nav-link:hover {
        color: #8f96a6 !important; /* Light color3 */
    }

    /* Main Content */
    .bg-light {
        background-color: #dbd0d9; /* Light color4 */
        padding: 20px;
    }
    .container-fluid{
      padding: 0 !important; 
    }
    /* Sidebar */
    .bg-secondary {
        background-color: #413932;
        padding: 0 !important;  
    }

    .nav-item {
        padding: 10px;
    }

    .nav-link {
        color: #ffffff !important; /* White color5 */
    }

    .nav-link:hover {
        color: #8f96a6 !important; /* Light color3 */
    }

   
    /* Updated color for the second navbar */
    .navbar-secondary {
        background-color: #8f96a6 !important; /* Light color4 */
    }

    /* Updated text color for the second navbar */
    .navbar-secondary .nav-link {
        color: #fff !important; /* Darker color2 */
    }
</style>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid p=0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg  navbar-light">
  <div class="container-fluid">
  <img src="../images/gemstone.png" alt="Logo" class="logo" style="height: 5%; width: 5%;">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
    <?php
    if(isset($_SESSION['username'])) {
        // If the user is logged in, show a link to the profile page
        echo '<a class="nav-link" href="user_area/profile.php">Profile</a>';
    } else {
        // If the user is not logged in, show a link to the registration page
        echo '<a class="nav-link" href="user_area/user_registration.php">Register</a>';
    }
    ?>
</li>

        <li class="nav-item">
          <a class="nav-link" href="#footer">Contact</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./user_area/cart.php">cart<sup><?php cart_item(); ?></sup></a></li>
</li>
        
      </ul>
      <form class="d-flex" method="get" action="search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
    </form>
    </div>
  </div>
</nav>
<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-dark navbar-secondary">
    <ul class="navbar-nav mg-auto">
    <?php
      if(isset($_SESSION['username'])){
    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome " .$_SESSION['username']."</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='index.php?logout=true'>Logout</a>
        </li>
        ";
      }else{
        echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='./user_area/user_login.php?logout=true'>Login</a>
        </li>";
      }
      if (isset($_GET['logout'])) {
        // Destroy the session
        session_destroy();
        // Redirect to a page after logout if needed
        echo "<script>window.location.href = './user_area/user_login.php';</script>";

        exit();
    }
      ?>
        
        
    </ul>
</nav>
<!--third child-->
<div class="bg-light">
    <h3 class="text-center">Store name</h3>
    <p class="text-center">Gemstone</p>
</div>

<!---fourth child-->
<div class="row px-2">
    <div class="col-md-10">
        <!--products-->
        <div class="row">
            <?php
            search_product();
        ?>
            
        </div>
    </div>
    
        
    <div class="col-md-2 bg-secondary">
        <!--sidenav-->
        <!--Brand-->
        
        <!--Categories-->
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item navbar">
                <h4 class="text-light m-auto">Categories</h4>

            </li>
            
            <?php
            getcategories()
            ?>
            
        </ul>
    </div>
    </div>

<!-- last child-->
<div id="footer">
<?php
include('.\includes\footer.php');
?>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
