Inserer votre message :<br><br>
<form action="minichat_post.php" method="post">
<p>
    pseudo <input type="text" name="pseudo" /><br><br>
    message <textarea rows="5" cols="33" name="message"></textarea><br><br>
    <input type="submit" value="Valider" /><br><br><br>
</p>
</form>

MESSAGES : <br><br>
<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM minichat');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p><?php echo $donnees['id']; ?> /
    <strong> <?php echo $donnees['pseudo']; ?></strong><br />
    a écrit : <?php echo $donnees['message']; ?>
<br>

   </p>
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>
