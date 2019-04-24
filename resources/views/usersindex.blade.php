@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">


<h1>Utilisateurs             </h1><br>
<?php

echo ' <a href="/users/create"> nouvelle fiche utilisateur   - </a>';
$x=0;echo ' - Info sur la dernière mise à jour <Font color=green>-Fiche mise à jour</font><Font color=blue>-Fiche nouvelle</font><Font color=red>-Fiche orpheline</font><br>';

                                            //statut 1 : fiche présente sans mise à jour
                                            //       2 : fiche présente avec mise à jour
                                            //       3 : fiche nouvelle
                                            //       4 : fiche sans correspondance
$color = array ('', '', '<b><Font color=green>', '<b><Font color=blue>', '<Font color=red>');

      foreach ($users as $user)
      {
$x=$x+1;if($x<10){$x="0".$x;}
                    echo '<tr> <form  method="POST" action="'.route('users.update', $user->id) .'">'. csrf_field() . method_field('PUT') ;

                    echo' <td >'.$color[$user->statut].$x.' <input  type="text" style="width: 100px;"  name="name" value="'. $user->name .'" >
                     <td ><input  type="text" style="width: 100px;"  name="firstname" value="'. $user->firstname .'" ></td>
                                             <td ><input type="radio" name="ajour" value="1"';
                        if ($user->ajour=='1'){echo 'checked';}
                       echo '> à jour<input type="radio" name="ajour" value="0"';
                        if ($user->ajour=='0'){echo 'checked';}
                        echo '> non</td>

                     <td ><label for="tel" ></label><input  type="text" style="width: 220px;" name="email" value="'. $user->email .'" ></td>
                      <td ><label for="email" ></label><input  type="text" style="width: 180px;" name="tel" value="'. $user->tel .'" ></td>


                         <td ><input type="radio" name="role" value="membre"';
                        if ($user->role=='membre'){echo 'checked';}
                       echo '> membre<input type="radio" name="role" value="admin"';
                        if ($user->role=='admin'){echo 'checked';}
                        echo '> admin</td>




                       <td style="width: 50px;"><button type="submit" class="btn btn-primary btn-sm">Enregistrer</button></td>
                      <td style="width: 50px;"><a href="/users/'.$user->id.'/destroy"><img src="images/Delete.png" alt="edit"/></a></td>

                    </font></b></form></tr>';
        ?>



      <?php

      }
      ?>



@endsection
