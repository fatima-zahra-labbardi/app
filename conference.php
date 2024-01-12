<?php
// Inclure la page de connexion
include 'connexion.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Conference Page</title>
</head>
<body>

<div class="container mt-5">
    <?php
    // Requête SQL pour sélectionner les champs spécifiques de la table events avec id_ctg égal à 4
    $sql = "SELECT e.id_event, e.titre, e.description, e.date_evenement, e.lieu, e.photo
            FROM events e
            JOIN categorie c ON e.id_ctg = c.id_ctg
            WHERE c.libelle_ctg = 'conference';";

    // Exécution de la requête
    $result = $link->query($sql);

    // Vérification si des résultats existent
    if ($result->num_rows > 0) {
        // Affichage des données
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card mb-3'>";
            // Affichage de la photo en haut
            $imagePath = "photo/" . $row["photo"];
            echo "<img class='card-img-top' src='" . $imagePath . "' alt='Photo de la conference' style='max-width:400px;'><br>";
        
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row["titre"] . "</h5>";
            echo "<p class='card-text'>" . $row["description"] . "</p>";
            echo "<p class='card-text'>Date : " . $row["date_evenement"] . "</p>";
            echo "<p class='card-text'>Lieu : " . $row["lieu"] . "</p>";

            // Formulaire pour l'inscription
            echo "<form method='post' action='inscription.php'>";
            echo "<input type='hidden' name='id_event' value='" . $row["id_event"] . "'>";
            echo "<button type='submit' class='btn btn-primary' name='participer'>Participer</button>";
            echo "</form>";

            echo "</div>"; // Fin de la card-body
            echo "</div>"; // Fin de la card
        }
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
