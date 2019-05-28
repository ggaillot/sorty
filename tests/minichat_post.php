<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On ajoute une entrée dans la table minichat
$req =$bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo,:message)');

$req->execute(array(
    'pseudo' => $_POST['pseudo'],
    'message' =>  $_POST['message']
    ));

?>
<meta http-equiv="refresh" content="0; url='minichat.php'" />
