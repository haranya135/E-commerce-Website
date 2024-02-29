<?php

    $username=$_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result_query);                
    $user_id=$row['user_id'];
    

  // SQL query to select orders for the specific user ID
$select_orders_query = "SELECT * FROM user_orders WHERE user_id = '$user_id'";
$result_orders = mysqli_query($con, $select_orders_query);

// Check if there are any orders for the user
if (mysqli_num_rows($result_orders) > 0) {
    // Start the table and apply some basic styling
    echo "<table style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background-color: #f2f2f2;'><th style='padding: 8px; border: 1px solid #ddd;'>S.No</th><th style='padding: 8px; border: 1px solid #ddd;'>Amount</th><th style='padding: 8px; border: 1px solid #ddd;'>Invoice No</th><th style='padding: 8px; border: 1px solid #ddd;'>Total Products</th><th style='padding: 8px; border: 1px solid #ddd;'>Order Date</th><th style='padding: 8px; border: 1px solid #ddd;'>Payment Status</th></tr>";

    // Initialize a counter variable for serial number
    $counter = 1;

    // Fetch and display each order as a table row
    while ($row = mysqli_fetch_assoc($result_orders)) {
        echo "<tr style='background-color: #fff;'>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $counter . "</td>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['amount'] . "</td>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['invoice_no'] . "</td>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;' class='text-center'>" . $row['total_products'] . "</td>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['order_date'] . "</td>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . ($row['order_state'] == 'pending' ? 'Incomplete' : 'Complete') . "</td>";
        echo "</tr>";

        // Increment the counter
        $counter++;
    }

    // Close the table
    echo "</table>";
} else {
    // If no orders are found for the user, display a message
    echo "No orders found for this user.";
}
?>
