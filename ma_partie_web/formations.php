<?php
// Connexion à la base de données (à ajuster selon votre configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evenement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Récupérer les événements depuis la base de données
$sql = "SELECT e.id_event, e.image, e.titre, e.description, e.date, e.lieu
        FROM events e
        JOIN categorie c ON e.id_ctg = c.id_ctg
        WHERE c.libelle_ctg = 'formation'";
$result = $conn->query($sql);

// Afficher les événements sous forme d'images avec lien de participation
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div style="margin: 20px; text-align: center;">';
        echo '<img src="' . $row['image'] . '" alt="' . $row['titre'] . '" style="max-width: 300px; max-height: 200px;">';
        echo '<h3>' . $row['titre'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p>' . $row['date'] . '</p>';

       // Lien vers Google Maps avec les coordonnées géographiques du lieu
        echo '<p><a href="https://www.google.com/maps/search/?api=1&query=' . urlencode($row['lieu']) . '" target="_blank">Localisation sur Google Maps</a></p>';
        echo '<a href="inscription.php?id=' . $row['id_event'] . '">Participer</a>';
        echo '</div>';
    }
} else {
    echo "Aucun événement trouvé.";
}

// Fermer la connexion
$conn->close();
?>

