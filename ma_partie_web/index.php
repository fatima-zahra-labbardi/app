
<?php
// Start the session
session_start();
include("connexion.php");

// Check if the user is already logged in
if (isset($_SESSION['admin_id'])) {
    // Redirect to admin dashboard or admin-specific page
    header("Location: admin_dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = $_POST['email'];

    // Validate admin email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($link, $email);

        // Check if the email belongs to an admin in the database
        $query = "SELECT id_admin, pass FROM admin WHERE mail = '$email'";
        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $admin = mysqli_fetch_assoc($result);

            // Set session variables and redirect to admin login page
            $_SESSION['admin_id'] = $admin['id_admin'];
            $_SESSION['admin_email'] = $email;

            // You may choose to redirect to admin_dashboard.php directly if you want
            header("Location: admin_login.php");
            exit();
        }
    }

    // If no, redirect to participant registration page
    header("Location: register.php?email=$email");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<body>

    <h1>Welcome to the Index Page</h1>

    <!-- Display the form for email input -->
    <form action="" method="post">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <button type="submit">Submit</button>
    </form>

</body>
</html>
