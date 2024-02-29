

    <h3 class="text-danger text-center">Delete Account</h3>
    <form action ="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete">
        </div>
    </form>

    <?php


// Check if the user is logged in (i.e., username is set in session)
if(isset($_SESSION['username'])) {
    // Retrieve the username from the session
    $username = $_SESSION['username'];
    if(isset($_POST['delete'])) {
    // Include your database connection file
    include('../includes/connect.php');

    // Prepare and execute a query to delete the user record from the user_table
    $delete_query = "DELETE FROM user_table WHERE username = ?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if(mysqli_affected_rows($con) > 0) {
        // Deletion successful
        echo "<script>alert('User account deleted successfully.')</script>";
    } else {
        // Deletion failed
        echo "<script>alert('Failed to delete user account.')</script>";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($con);
    session_destroy();
    echo "<script>window.location.href = '../index.php';</script>";
    


}else if(isset($_POST['dont_delete'])){
    echo "<script>window.location.href = 'profile.php';</script>";
   
}
}


// Redirect to the index page

exit; // Ensure that no further code is executed after the redirection
?>


