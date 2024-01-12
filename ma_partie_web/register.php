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

// Initialiser les variables
$nom = $prenom = $email = $password = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validation des champs (ajoutez d'autres validations si nécessaire)
    if (empty($nom)) { array_push($errors, "Le nom est requis"); }
    if (empty($prenom)) { array_push($errors, "Le prénom est requis"); }
    if (empty($email)) { array_push($errors, "L'email est requis"); }
    if (empty($password)) { array_push($errors, "Le mot de passe est requis"); }

    // Vérification si l'email appartient à la table admin
    $admin_check_query = "SELECT * FROM admin WHERE mail='$email' LIMIT 1";
    $result = mysqli_query($conn, $admin_check_query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin) {
        // Redirection vers la page d'administration des événements pour les administrateurs
        header('location: admin_events.php');
    } else {
        // Insertion des données dans la table participant pour les non-administrateurs
        $insert_query = "INSERT INTO participant (nom, prenom, role, mail, pass) VALUES ('$nom', '$prenom','$role', '$email', '$password')";
        mysqli_query($conn, $insert_query);
        // Redirection vers une autre page pour les non-administrateurs
        header('location: user_events.php');
    }
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
</head>
<body>
    <h2>Création de compte</h2>

    <?php include('errors.php'); ?>

    <form method="post" action="register.php">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" required>


        <label for="role">Role:</label>
        <input type="text" name="role" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required>

        <button type="submit">Créer le compte</button>
    </form>
</body>
</html>
