<?php
//recuperation des données de l'url

$id=$_GET['id'];
$name= $_GET['name'];
$firstname=$_GET['firstname'];


echo '  // id = '.$id;
//update
$bdd = new PDO('mysql:host=localhost;dbname=sorty;charset=utf8', 'root', '');

$bdd->exec('UPDATE users SET name ="'.$name.'", firstname = "'.$firstname.'" where  id ='.$id.';');


?>
