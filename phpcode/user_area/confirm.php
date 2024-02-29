<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order</title>
    <style>
        body {
            background-color: #999; /* Grey background color */
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh; /* Full height of the viewport */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            padding: 50px;
            background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent black background */
            border-radius: 10px;
            display: flex; /* Use flexbox */
    flex-direction: column; /* Arrange items vertically */
    align-items: center; /* Center items horizontally */
    justify-content: center; /* Center items vertically */
        }
        .container h2, .container h3, .container p, .container label, .container button, .container select {
            font-size: 20px; /* Larger font size */
            margin-bottom: 20px; /* Space between lines */
            width: 100%; /* Ensure uniform width for all elements */
            padding: 10px; /* Add padding for better readability */
            border: none; /* Remove borders */
            border-radius: 5px; /* Add border radius */
            background-color: #333; /* Darker background color */
            color: white;
            cursor: pointer; /* Change cursor to pointer on hover */
            transition: background-color 0.3s; /* Smooth transition for background color change */
        }
        .container label {
            display: block; /* Ensure labels are displayed as block elements */
            margin: 10px; /* Add extra space below labels */
        }
        .container button:hover, .container select:hover {
            background-color: #555; /* Darker background color on hover */
        }
        .confirm-button, .cancel-button {
    background-color: #008CBA; /* Blue for confirm, Red for cancel */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 10px; /* Add margin for spacing */
    cursor: pointer;
    border-radius: 10px;
    transition: background-color 0.3s; /* Smooth transition for background color change */
}

.cancel-button {
    background-color: #f44336; /* Red */
}

.confirm-button:hover, .cancel-button:hover {
    background-color: #555; /* Darker background color on hover */
}

    </style>
</head>
<body>
<div class="container">
    <?php
    // Include your database connection file
    include('../includes/connect.php');
    session_start();
    
    // Check if the invoice number is set in the URL query parameter
    if(isset($_GET['invoice_no'])) {
        // Retrieve the invoice number from the URL query parameter
        $invoice_no = $_GET['invoice_no'];
        
        // Fetch invoice details from the database based on the invoice number
        $select_query = "SELECT * FROM `user_orders` WHERE invoice_no = '$invoice_no'";
        $result_query = mysqli_query($con, $select_query);
        $row = mysqli_fetch_assoc($result_query);
        
        // Display the invoice details
        if($row) {
            echo "<h2>Invoice Number: $invoice_no</h2>";
            echo "<h3>Amount: $" . $row['amount'] . "</h3>";
        } else {
            echo "<p>Invoice not found!</p>";
        }
    } else {
        echo "<p>Invoice number not provided!</p>";
    }
    ?>

    <label for='payment_mode'>Select Payment Mode:</label>
    <select id='payment_mode' name='payment_mode'>
        <option value='cashback'>Cashback</option>
        <option value='paytm'>Paytm</option>
        <option value='gpay'>GPay</option>
        <option value='netbanking'>Net Banking</option>
    </select>
    
    <br>
    <a href='#' onclick="confirmOrder('<?php echo $invoice_no; ?>')" class='confirm-button'>Confirm Order</a>
    <a href='?action=cancel&invoice_no=<?php echo $invoice_no; ?>' class='cancel-button'>Cancel</a>
</div>
<script>
function confirmOrder(invoice_no) {
    // Get the selected payment mode
    var paymentMode = document.getElementById('payment_mode').value;
    
    // Redirect to the confirmation URL with payment mode and invoice number
    window.location.href = "?action=confirm&invoice_no=" + invoice_no + "&payment_mode=" + paymentMode;
    console.log(window.location.href);
}
</script>

<?php

// Check if the confirm action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
    $invoice_no = $_GET['invoice_no']; 
    $select_query = "SELECT * FROM `user_orders` WHERE invoice_no = '$invoice_no'";
        $result_query = mysqli_query($con, $select_query);
        $row = mysqli_fetch_assoc($result_query);
        $order_id=$row['order_id'];
        $amount=$row['amount'];
        $payment_mode=$_GET['payment_mode'];
        
    $insert_query = "INSERT INTO user_payments (order_id, invoice_no, amount, payment_mode, date) 
    VALUES ('$order_id', '$invoice_no', '$amount', '$payment_mode',NOW())";

    $result_update2 = mysqli_query($con, $insert_query);
    $update_query = "UPDATE `user_orders` SET order_state = 'confirmed' WHERE invoice_no = '$invoice_no'";
    $result_update = mysqli_query($con, $update_query);
    
    if ($result_update2 && $result_update) {
        // Order state updated successfully
        echo "<script>alert('Order confirmed!')</script>";
        echo "<script> window.location.href = 'profile.php'; </script>";

    } else {
        // Failed to update order state
        echo "<script>alert('Failed to confirm order.')</script>";
    }
}

// Check if the cancel action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'cancel') {
    // Perform actions to cancel the order here
    if(isset($_GET['invoice_no'])) {
        // Retrieve the invoice number from the URL query parameter
        $invoice_no = $_GET['invoice_no'];
    
        // Delete row with the given invoice number from user_orders table
        //$delete_query_user_orders = "DELETE FROM user_orders WHERE invoice_no = '$invoice_no'";
        //$result_user_orders = mysqli_query($con, $delete_query_user_orders);
    
        // Delete row with the given invoice number from pending_orders table
        $delete_query_pending_orders = "DELETE FROM orders_pending WHERE invoice_no = '$invoice_no'";
        $result_pending_orders = mysqli_query($con, $delete_query_pending_orders);
    
        if ( $result_pending_orders) {
            // Deletion successful
            echo "<script>alert('Order Canceled')</script>";
            // Redirect to the profile page or any other desired location
            echo "<script>window.location.href = 'profile.php';</script>";
        } else {
            // Failed to delete rows
            echo "<script>alert('Failed to delete rows.')</script>";
            // Redirect to an error page or handle the error appropriately
        }
    } else {
        echo "<p>Invoice number not provided!</p>";
    }

    echo "<script> window.location.href = 'profile.php'; </script>";
}
?>
