@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">


<h1>Utilisateurs             </h1><br><br>

</div></div>
<div class="container">

<?php
 session(['creauser' => '/userslist']);

echo '<BR><BR><a href="/users/create"> nouvelle fiche utilisateur (invité)  - </a>
pour modifier les utilisateurs contacter Jacquot <BR><BR>';

      foreach ($users as $user)
      {

                    echo '<table><tbody><tr> ';

                    echo '<td style="width:170px;">'. $user->name .' ';
                    echo '</td>';
                    echo '<td style="width: 170px;">'. $user->firstname .' ';

                    if($user->role=='invité'){echo '---(invité)';}
                    echo '</td>';
                    echo '<td style="width: 120px;">'. $user->tel.'</td>'    ;
                    echo '<td >'. $user->email.'</td>
                    </tr></tbody></table>'    ;

      }
      ?>
</div></div>


@endsection
