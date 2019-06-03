
<?php
//créer l'objet $bdd

$bdd = new PDO('mysql:host=localhost;dbname=sorty;charset=utf8', 'root', '');

$ensemble_des_donnees = $bdd->query('SELECT * FROM users');

//while ($un_enregistrement = $ensemble_des_donnees->fetch())     //  2 boucles possibles while ou foreach
foreach ($ensemble_des_donnees as $un_enregistrement)
        {
        echo $un_enregistrement['firstname'] .' '.$un_enregistrement['name']. '<br />';
        }

// $ensemble_des_donnees->closeCursor();


