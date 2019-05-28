@extends('layouts.app')
@section('content')


<div class="container">



<h1>Utilisateurs modif mot de passe <Font color='red'>-->> à utiliser avec précautions            </font></h1><br>

ce qui est affiché est le mot de passe crypté <br>
dans le champ mot de de passe : rentrer en clair le mot de passe , il sera crypté à l'enregistrement<br>
impossible de connaître un mot de passe déjà enregistré<br><br>
<Font color='white'>----------------------------------------------------------------------------------</font>MOT DE PASSE (CRYPTE)
<?php
$x=0;

                                            //statut 1 : fiche présente sans mise à jour
                                            //       2 : fiche présente avec mise à jour
                                            //       3 : fiche nouvelle
                                            //       4 : fiche sans correspondance
$color = array ('', '', '<b><Font color=green>', '<b><Font color=blue>', '<Font color=red>');

      foreach ($users as $user)
      {
$x=$x+1;if($x<10){$x="0".$x;}
                    echo '<tr> <form  method="POST" action="'.route('users.update2', $user->id) .'">'. csrf_field() . method_field('PUT') ;

                    echo' <td >'.$color[$user->statut].$x.' <input  type="text" style="width: 100px;"  name="name" value="'. $user->name .'" >
                     <td ><input  type="text" style="width: 100px;"  name="firstname" value="'. $user->firstname .'" ></td>
                                             <td >
                     <td ><label for="tel" ></label><input  type="text" style="width: 220px;" name="email" value="'. $user->email .'" ></td>
                                          <td > <input  type="text" style="width: 300px;"  name="password" value="'. $user->password .'" >
                     </td >';
                     if ($user->remember_token<>Null){echo '<td>enregistré </td>';}else {echo '<td>-----------</td>';}



     echo '<td style="width: 50px;"><button type="submit" class="btn btn-primary btn-sm">Enregistrer</button></td>
                      <td style="width: 50px;"><a href="/users/'.$user->id.'/destroy"><img src="images/Delete.png" alt="edit"/></a></td>

                    </font></b></form></tr>';
        ?>



      <?php

      }
      ?>



@endsection
