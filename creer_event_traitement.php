<?php
include("connexion.php");
session_start();

// Vérifier si le formulaire a été soumis
if (isset($_POST["enregistrer"])) {

    // Gestion du téléchargement de l'image
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $dossier = 'photo/';
        $temp_name = $_FILES['photo']['tmp_name'];

        // Vérifier si le fichier est une image
        $allowed_extensions = array('png', 'jpeg', 'jpg');
        $file_info = pathinfo($_FILES['photo']['name']);
        $extension = strtolower($file_info['extension']);

        if (!in_array($extension, $allowed_extensions)) {
            exit("Erreur, Veuillez insérer une image (extensions autorisées: png, jpeg, jpg)");
        }

        // Générer un nom unique haché pour le fichier image
        $nom_photo = md5(uniqid()) . '.' . $extension;

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (!move_uploaded_file($temp_name, $dossier . $nom_photo)) {
            exit("Problème dans le téléchargement de l'image, réessayez");
        }
    } else {
        // Si aucune image n'est téléchargée, utiliser une image par défaut
        $nom_photo = "SANS_IMAGE.jpeg";
    }

    // Récupérer les autres données du formulaire
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $lieu = $_POST["localisation"];
    $date = $_POST["date"];
    $id_ctg = $_POST["id_ctg"];

    // Utilisation d'une requête préparée
    $sql = "INSERT INTO `events` (`titre`, `description`, `date`, `lieu`, `photo`, `id_ctg`) VALUES (?, ?, ?, ?, ?, ?)";
    $requete = $link->prepare($sql);

    if ($requete) {
        // Liaison des paramètres et exécution de la requête
        $requete->bind_param("ssssss", $titre, $description, $date, $lieu, $nom_photo, $id_ctg);
        $resultat = $requete->execute();

        if ($resultat) {
            header("location:acceuil.php");
        } else {
            echo "Erreur lors de l'insertion : " . $requete->error;
        }

        // Fermeture de la requête
        $requete->close();
    } else {
        echo "Erreur lors de la préparation de la requête : " . $link->error;
    }
} else {
    exit("Erreur, le formulaire n'a pas été soumis correctement.");
}
?>
