<html>
<head>
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<title></title>
</head>
<body>
<div style="margin-left: 40px;"><h1>Sorties Parapangue</h1><br>


<br>
Vous êtes inscrit.e à la sortie du <b>{{ session('title')}}</b>
<br><br>{{ session('comment')}}
<br><br><b>Liste des participants et coordonnées</b><br>
<?php
echo session('text').'<br><br>';
//echo session('email');
?>



</div>
</body>
</html>
