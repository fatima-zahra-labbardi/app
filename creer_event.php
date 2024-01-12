<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer Evenement</title>
    <style type="text/css">
        label {
            width: 110px;
            display: inline-block;
            margin: 6px;
        }
</style>
</head>
<body>
    <form  method="post" enctype="multipart/form-data"action="creer_event_traitement.php" method="post">
        <label for="">Titre:</label>
        <input type="text" name="titre" required> <br><br>
        <label for="" >Categorie</label>
        <select name="id_ctg">
            <option value="1">Forum</option>
            <option value="2">Formation</option>
            <option value="3">Evenement</option>
            <option value="4">Conference</option>
	    </select><br><br>
        <label for="">Description:</label>
        <input type="text" name="description" required> <br><br>
        <label for="localisation">Lieu de l'événement:</label>
        <input type="text" id="localisation" name="localisation"><br><br>
        <label for="">Date:</label>
        <input type="date" id="start" name="date"> <br><br>
        <label for="image">Photo </label>
	    <input type="file" name="photo" required><br><br>
        <input type="submit" name="enregistrer" value="Créer l'événement" class="submit">
            
            
    </form>
</body>
</html>