<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Usertemp;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Particip;
use App\Models\User;
use App\Models\Sor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {        if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
 if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
       return view('import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
public function import()
    {
    //importation fichier extérieur
        DB::table('usertemps')->delete();
        Excel::import(new UsersImport,request()->file('file'));
                    //analyse table Usertemp et mise à jour
                    // mettre toutes les fiches à statut = 4
                    $users=User::all();$usertemps=Usertemp::all();
 foreach ($users as $user){$user->statut=4;$user->save();}

                            foreach ($usertemps as $usertemp)
                                        { $x=0;    $emailusertemp=$usertemp->email;

                                     foreach ($users as $user){     $emailuser=$user->email;
                                            //statut 1 : fiche présente sans mise à jour
                                            //       2 : fiche présente avec mise à jour
                                            //       3 : fiche nouvelle
                                            //       4 : fiche sans correspondance
                                                                if ($emailuser==$emailusertemp){$x=1;
                                                                    if ($user->name==$usertemp->name and
                                                                    $user->firstname==$usertemp->firstname and
                                                                    $user->tel==$usertemp->tel and
                                                                    $user->ajour==$usertemp->ajour)
                                                                    {$user->statut=1;$user->save();}
                                                                   else
                                                                    {$user->name=$usertemp->name ;
                                                                     $user->firstname=$usertemp->firstname ;
                                                                     $user->tel=$usertemp->tel;
                                                                     $user->email=$usertemp->email ;
                                                                     $user->ajour=$usertemp->ajour;
                                                                     $user->role=$usertemp->role;
                                                                     $user->statut=2;
                                                                     $user->save();}}
                                                                     else{

                                                                     }
                                                               }
                                    if ($x==0){  $user=new User;
                                                 $user->name=$usertemp->name ;
                                                 $user->firstname=$usertemp->firstname ;
                                                 $user->email=$usertemp->email ;
                                                 $user->tel=$usertemp->tel;
                                                 $user->ajour=$usertemp->ajour;
                                                 $user->statut=3;
                                                 $user->role='membre';
                                                 $user->save(); }


                                        }

return Redirect::to('/users')->with('success', 'importation effectuée');
     }


}
