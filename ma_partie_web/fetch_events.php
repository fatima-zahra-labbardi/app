<?php
include('connexion.php');

// Check if a category is selected
if (isset($_GET['category'])) {
    // Fetch events based on the selected category
    $selectedCategory = $_GET['category'];
    $sqlEvents = "SELECT id_event, image, titre, description, date, lieu
                  FROM events
                  WHERE id_ctg = '$selectedCategory'";
} else {
    // Fetch all events
    $sqlEvents = "SELECT id_event, image, titre, description, date, lieu FROM events";
}

$resultEvents = $link->query($sqlEvents);

// Afficher les événements sous forme d'images avec lien de participation
if ($resultEvents->num_rows > 0) {
    while ($rowEvent = $resultEvents->fetch_assoc()) {
        echo '<div style="margin: 20px; text-align: center;">';
        echo '<img src="' . $rowEvent['image'] . '" alt="' . $rowEvent['titre'] . '" style="max-width: 300px; max-height: 200px;">';
        echo '<h3>' . $rowEvent['titre'] . '</h3>';
        echo '<p>' . $rowEvent['description'] . '</p>';
        echo '<p>' . $rowEvent['date'] . '</p>';
        // Lien vers Google Maps avec les coordonnées géographiques du lieu
        echo '<p><a href="https://www.google.com/maps/search/?api=1&query=' . urlencode($rowEvent['lieu']) . '" target="_blank">Localisation sur Google Maps</a></p>';
        echo '<a href="inscription.php?id=' . $rowEvent['id_event'] . '">Participer</a>';
        echo '</div>';
    }
} else {
    echo "Aucun événement trouvé.";
}

$link->close();
?>
