<?php
//recuperation des données de l'url

$id=$_GET['id'];
$bdd = new PDO('mysql:host=localhost;dbname=sorty;charset=utf8', 'root', '');

echo '  // id = '.$id;
//formulaire correspondant à id

$enregistrement = $bdd->query('SELECT * FROM `users` where  id ='.$id.';');
$donnees = $enregistrement->fetch();
echo '<form   action="update2.php"  method="GET">';
echo '<INPUT NAME="firstname" value="'.$donnees['firstname'].'" >firstname<br>';
echo '<INPUT NAME="name" value="'.$donnees['name'].'" >name<br>';
echo '<INPUT  type=hidden NAME="id" value='.$donnees['id'].'>';
echo '<INPUT type=submit value=valider><br>';
echo '<INPUT type=reset value=Annuler>
      </form>';

// envoi vers update2.php pour update


?>
