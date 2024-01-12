<?php
include 'connexion.php';
session_start();

if (isset($_POST['participer'])) {
    // Récupérer les données du formulaire
    $id_event = $_POST['id_event'];
    // Obtenez l'id_participant à partir de la session ou d'où vous stockez cette information
    $id_part = $_SESSION['id_participant']; // Assurez-vous que cette variable est correctement définie

    // Vérifier si l'utilisateur n'est pas déjà inscrit à cet événement
    $checkInscription = "SELECT * FROM inscription WHERE id_event = ? AND id_part = ?";
    $stmtCheck = $link->prepare($checkInscription);
    $stmtCheck->bind_param("ii", $id_event, $id_part);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows == 0) {
        // Insérer dans la table "inscription"
        $insertInscription = "INSERT INTO inscription (id_event, id_part) VALUES (?, ?)";
        $stmtInsert = $link->prepare($insertInscription);
        $stmtInsert->bind_param("ii", $id_event, $id_part);
        $resultInsert = $stmtInsert->execute();

        if ($resultInsert) {
            echo "participation réussie!";
        } else {
            echo "Erreur lors de l'inscription : " . $stmtInsert->error;
            
        }
    } else {
        echo "Vous êtes déjà inscrit à cet événement.";
    }

    // Fermeture des requêtes préparées
    $stmtCheck->close();
    $stmtInsert->close();
}

// Fermeture de la connexion à la base de données
$link->close();
?>
