<?php
include('connexion.php');

// Récupérer les catégories depuis la base de données
$sqlCategories = "SELECT id_ctg, libelle_ctg FROM categorie";
$resultCategories = $link->query($sqlCategories);

// Récupérer tous les événements depuis la base de données
$sqlAllEvents = "SELECT id_event, image, titre, description, date, lieu FROM events";
$resultAllEvents = $link->query($sqlAllEvents);

// Vérifier si des catégories existent
if ($resultCategories->num_rows > 0) {
    echo '<form id="categoryForm">';
    echo '<label for="category">Sélectionner une catégorie :</label>';
    echo '<select name="category" id="category" onchange="fetchEvents()">';
    
    // Ajouter un élément de liste vide
    echo '<option value="" disabled selected>Choisir une catégorie</option>';

    // Afficher les options de la liste déroulante avec les catégories
    while ($rowCategory = $resultCategories->fetch_assoc()) {
        echo '<option value="' . $rowCategory['id_ctg'] . '">' . $rowCategory['libelle_ctg'] . '</option>';
    }

    echo '</select>';
    echo '</form>';

    echo '<div id="eventsContainer">';
    
    // Afficher tous les événements par défaut
    while ($rowEvent = $resultAllEvents->fetch_assoc()) {
        echo '<div style="margin: 20px; text-align: center;">';
        echo '<img src="' . $rowEvent['image'] . '" alt="' . $rowEvent['titre'] . '" style="max-width: 300px; max-height: 200px;">';
        echo '<h3>' . $rowEvent['titre'] . '</h3>';
        echo '<p>' . $rowEvent['description'] . '</p>';
        echo '<p>' . $rowEvent['date'] . '</p>';
        echo '<p><a href="https://www.google.com/maps/search/?api=1&query=' . urlencode($rowEvent['lieu']) . '" target="_blank">Localisation sur Google Maps</a></p>';
        echo '<a href="inscription.php?id=' . $rowEvent['id_event'] . '">Participer</a>';
        echo '</div>';
    }
    
    echo '</div>';

} else {
    echo "Aucune catégorie trouvée.";
}
?>





<script>
function fetchEvents() {
    var categoryId = document.getElementById("category").value;

    // Make an AJAX request to fetch events based on the selected category
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the events container with the fetched events
            document.getElementById("eventsContainer").innerHTML = xhr.responseText;
        }
    };

    // Fetch events based on the selected category
    xhr.open("GET", "fetch_events.php?category=" + categoryId, true);
    xhr.send();
}
</script>


