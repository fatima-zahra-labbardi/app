<?php
// Start the session
session_start();
include('connexion.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to the index page or admin login page
    header("Location: index.php");
    exit();
}

// Retrieve the admin's ID
$adminId = $_SESSION['admin_id'];

// Your database connection logic here
// ...

// Rest of your admin_dashboard.php logic...

// Fetch events created by the logged-in admin
$sqlAdminEvents = "SELECT id_event, titre, description, date, lieu,image  FROM events WHERE id_admin = '$adminId'";
$resultAdminEvents = $link->query($sqlAdminEvents);

// Fetch remaining events (not created by the admin)
$sqlAllEvents = "SELECT id_event, titre, description, date, lieu,image FROM events WHERE id_admin != '$adminId'";
$resultAllEvents = $link->query($sqlAllEvents);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Welcome to the Admin Dashboard</h1>

    <!-- Button to view admin's events -->
    <a href="#adminEvents">Mes Événements</a>

    <!-- Button to add a new event -->
    <a href="add_event.php">Ajouter un Événement</a>

    <!-- Display events created by the logged-in admin -->
<div id="adminEvents">
    <h2>Mes Événements</h2>
    <?php
    if ($resultAdminEvents->num_rows > 0) {
        while ($rowAdminEvent = $resultAdminEvents->fetch_assoc()) {
            // Display admin's events
            echo '<div style="margin: 20px; text-align: center;">';
            // Display event image
            echo '<img src="' . $rowAdminEvent['image'] . '" alt="' . $rowAdminEvent['titre'] . '" style="max-width: 300px; max-height: 200px;">';
            // Display event details (adjust as needed)
            echo '<h3>' . $rowAdminEvent['titre'] . '</h3>';
            echo '<p>' . $rowAdminEvent['description'] . '</p>';
            echo '<p>' . $rowAdminEvent['date'] . '</p>';
            echo '<p>' . $rowAdminEvent['lieu'] . '</p>';
            // Additional details or actions if needed
            echo '</div>';
        }
    } else {
        echo "Aucun événement créé par cet admin.";
    }
    ?>
</div>
<!-- Display all events -->
<div id="allEvents">
    <h2>Tous les Événements</h2>
    <?php
    if ($resultAllEvents->num_rows > 0) {
        while ($rowAllEvent = $resultAllEvents->fetch_assoc()) {
            // Display all events
            echo '<div style="margin: 20px; text-align: center;">';
            // Display event image
            echo '<img src="' . $rowAllEvent['image'] . '" alt="' . $rowAllEvent['titre'] . '" style="max-width: 300px; max-height: 200px;">';
            // Display event details (adjust as needed)
            echo '<h3>' . $rowAllEvent['titre'] . '</h3>';
            echo '<p>' . $rowAllEvent['description'] . '</p>';
            echo '<p>' . $rowAllEvent['date'] . '</p>';
            echo '<p>' . $rowAllEvent['lieu'] . '</p>';
            // Additional details or actions if needed
            echo '</div>';
        }
    } else {
        echo "Aucun événement disponible.";
    }
    ?>
</div>

</body>
</html>
