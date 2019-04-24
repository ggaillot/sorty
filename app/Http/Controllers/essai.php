<?php

$users=User::all();
foreach ($users as $user) {$user->statut=0;$user->save();}

        $usertemps=Usertemp::all();
        foreach ($usertemps as $usertemp)
            { $user1=User::where('email','=',$usertemp->email)->get();
                //statut 1 : fiche présente sans mise à jour
                //       2 : fiche présente avec mise à jour
                //       3 : fiche nouvelle
                //       4 : fiche sans correspondance
                    if ($user1->count()>0)
                              {  $user=$user1[0];



 $usertemps=Usertemp::all();
       foreach ($usertemps as $usertemp)
            { echo $usertemp->email;

            }
            foreach ($usertemps as $usertemp => $value) {
                echo $usertemp->email;
            }
