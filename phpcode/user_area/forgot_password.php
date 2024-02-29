<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            text-align: center;
        }
        form {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Forgot Password</h2>

    <?php
    session_start();
    include('../includes/connect.php'); // Include your database connection file
    $display_username_email_field = true;
    $display_otp_form=false;
    $display_reset_password_form=false;
    // Handling form submission when the user submits their username or email
    if (isset($_POST['submit'])) {
        // Retrieve username or email from the form
        $username_or_email = $_POST['username_or_email'];

        // Query to retrieve email based on username or email
        $query = "SELECT user_email FROM user_table WHERE username = '$username_or_email' OR user_email = '$username_or_email'";
        $result = mysqli_query($con, $query);
        $row_count = mysqli_num_rows($result);

        if ($row_count > 0) {
            // Email found in database
            $row_data = mysqli_fetch_assoc($result);
            $user_email = $row_data['user_email'];
            $_SESSION['user_email'] = $user_email;

            // Call Python script to send OTP
            $python_script = 'python send_otp.py';
            $command = escapeshellcmd("$python_script $user_email");
            $verification_result = shell_exec($command);

            // Check if Python script executed successfully and extract OTP
            if ($verification_result === false) {
                // Error executing Python script
                echo "<script>alert('Error sending OTP')</script>";
            } else {
                // Split the output to get result and OTP
                $output_parts = explode(" ", trim($verification_result));
                $result_msg = $output_parts[0];
                $sent_otp = $output_parts[1];

                // Process the result and OTP accordingly
                if ($result_msg === "successfully" && $sent_otp !== null) {
                    // OTP sent successfully, proceed to OTP verification
                    $_SESSION['sent_otp'] = $sent_otp; // Store sent OTP in session
                    $display_username_email_field = false;
                    $display_otp_form=true;
                    echo "<script>alert('OTP sent successfully')</script>";
                } else {
                    // Failed to send OTP
                    echo "<script>alert('Failed to send OTP')</script>";
                }
            }
        } else {
            // Username or email not found in database
            echo "<script>alert('Username or email not found')</script>";
        }
    }

    // Handling form submission when the user submits the OTP verification form
    if (isset($_POST['verify_otp'])) {
        // Retrieve entered OTP from the form
        $entered_otp = $_POST['otp'];

        // Check if entered OTP matches the sent OTP
        if (isset($_SESSION['sent_otp']) && $_SESSION['sent_otp'] === $entered_otp) {
            // OTP verification successful
            echo "<script>alert('OTP verified successfully')</script>";

            // Display the reset password form
            $display_reset_password_form = true;
            $display_otp_form = false;
            $display_username_email_field = false;
        } else {
            // Invalid OTP
            echo "<script>alert('Invalid OTP')</script>";
        }
    }

    // Handling form submission when the user submits the reset password form
    if (isset($_POST['reset_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Ensure passwords match
        if ($new_password == $confirm_password) {
            // Passwords match, update the user's password in the database
            // Assuming you have a session variable for the user's email
            $user_email = $_SESSION['user_email'];

            // Hash the new password before updating it in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $update_query = "UPDATE user_table SET user_password = '$hashed_password' WHERE user_email = '$user_email'";
            $update_result = mysqli_query($con, $update_query);

            if ($update_result) {
                echo "<script>alert('Password updated successfully')</script>";
                echo "<script>window.location.href = 'user_login.php';</script>";
            } else {
                echo "<script>alert('Error updating password')</script>";
            }
        } else {
            // Passwords do not match, display error message
            echo "<script>alert('Passwords do not match')</script>";
        }
    }
    ?>

    <!-- Form for submitting username or email -->
    <form method="post">
        <?php if ($display_username_email_field): ?>
            <div>
                <label for="username_or_email">Enter Email:</label>
                <input type="text" id="username_or_email" name="username_or_email" required>
            </div>
            <button type="submit" name="submit">Submit</button>
        <?php endif; ?>
    </form>

    <!-- Form for OTP verification -->
    <?php if ($display_otp_form): ?>
        <form method="post">
            <div>
                <label for="otp">Enter OTP:</label>
                <input type="text" id="otp" name="otp" required>
            </div>
            <button type="submit" name="verify_otp">Verify OTP</button>
        </form>
    <?php endif; ?>

    <!-- Reset password form -->
    <?php if ($display_reset_password_form): ?>
        <form method="post">
            <div>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="reset_password">Reset Password</button>
        </form>
    <?php endif; ?>

</body>
</html>