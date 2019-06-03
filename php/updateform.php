<?php
//recuperation des données du formulaire
$name= $_POST['name'];
$firstname=$_POST['firstname'];
$id=$_POST['id'];
echo ' verification : name '.$name.' et firstname : '.$firstname.' // id = '.$id;
//update

$bdd = new PDO('mysql:host=localhost;dbname=sorty;charset=utf8', 'root', '');

$bdd->exec('UPDATE users SET name ="'.$name.'", firstname = "'.$firstname.'" where  id ='.$id.';');


?>
