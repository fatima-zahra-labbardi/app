<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to the index page or admin login page
    header("Location: index.php");
    exit();
}

// Rest of your admin login logic...

// Retrieve the pre-filled email if available
$preFilledEmail = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

// ... (rest of your admin login logic)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

    <h1>Welcome to the Admin Login Page</h1>

    <!-- Display the form for admin login with pre-filled email -->
    <form action="admin_dashboard.php" method="post">
        <label for="email">Admin Email:</label>
        <input type="email" name="email" value="<?php echo $preFilledEmail; ?>" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>

</body>
</html>
