
<?php
//créer l'objet $bdd
echo ' afficher le premier enregistrement';
$bdd = new PDO('mysql:host=localhost;dbname=sorty;charset=utf8', 'root', '');
// trouver le premier enregistrement
$enregistrement = $bdd->query('SELECT * FROM `users` order by id asc limit 1');
$donnees = $enregistrement->fetch();
echo '<form   action="updateform.php"  method="POST">';
echo '<INPUT NAME="firstname" value="'.$donnees['firstname'].'" >firstname<br>';
echo '<INPUT NAME="name" value="'.$donnees['name'].'" >name<br>';
echo '<INPUT  type=hidden NAME="id" value='.$donnees['id'].'>';
echo '<INPUT type=submit value=valider><br>';
echo '<INPUT type=reset value=Annuler>
      </form>';


