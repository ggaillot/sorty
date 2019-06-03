<?php
// localise l'installation composer
require('../vendor/autoload.php');
$faker = Faker\Factory::create('fr_FR');

//CONNEXION à la base de données : https://www.php.net/manual/fr/pdo.connections.php
$dbh = new PDO('mysql:host=localhost;dbname=sorty;charset=UTF8','root','');
//insert en mode PDO : https://php.net/manual/fr/pdo.prepared-statements.php
$stmt = $dbh->prepare("INSERT INTO essai (name, firstname) VALUES (:name, :firstname)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':firstname', $firstname);

for ($i = 0; $i < 5; $i++){
$name = $faker->lastName;
$firstname = $faker->firstName;
$stmt->execute();
}

// regarder la doc pour la gestion des erreurs  try ... catch

?>






