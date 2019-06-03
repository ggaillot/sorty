<?php
//recuperation des données de l'url

$id=$_GET['id'];
$bdd = new PDO('mysql:host=localhost;dbname=sorty;charset=utf8', 'root', '');

echo '  // id = '.$id;
//DELETE



$bdd->exec('DELETE FROM users where  id ='.$id.';');


?>
