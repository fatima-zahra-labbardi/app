<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Creer Compte</title>
<style type="text/css">
   label {
  width: 110px;
  display: inline-block;
  margin: 6px;
}
</style>
</head>
<body>
<form  method="post" enctype="multipart/form-data"action="compte_traitement.php" method="post">
            <label for="">Login:</label>
            <input type="text" name="login" required> <br><br>
            <label for="">Numero d'Apogee:</label>
            <input type="text" name="id_part" required> <br><br>
            <label for="">Mot De Passe:</label> 
            <input type="text" name="passe" required> <br><br>
            <label for="" >Nom</label>
            <input type="text" name="nom" required> <br><br>
            <label for="" >Prénom</label>
            <input type="text" name="prenom" required> <br><br>
            <label for="">Email</label>
            <input type="text" name="email" required> <br><br>
            <label for="">Role</label>
            <input type="text" name="role" required> <br><br>
            <input type="submit" name="enregistrer" value="Enregistrer" class="submit">
            
            
        </form>
</body>
</html>