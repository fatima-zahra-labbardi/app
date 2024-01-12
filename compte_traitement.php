<?php
include ("connexion.php");
session_start();

$login=$_POST["login"];
$numap=$_POST["id_part"];
$password=$_POST["passe"];
$nom=$_POST["nom"];
$role=$_POST["role"];
$prenom=$_POST["prenom"];
$email=$_POST["email"];

$sql="INSERT INTO `participant`(`login`, `id_part`, `passe`, `nom`, `prenom`, `role`, `mail`) VALUES ('$login','$numap','$password','$nom','$prenom','$role','$email')";
$res= mysqli_query($link, $sql);
if ($res==false) {
    
    echo "Erreur!!";
}
else{
    header("location:index.php");
}



?>