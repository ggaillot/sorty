<?php

namespace App\Http\Controllers;


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
Date::setLocale('fr');




class ParticipController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index()
             {
                             if (is_null(Auth::user())){
                             }
                             else
                             {
                                     session(['role' => User::find(Auth::user()->id)->role]);
                                     session(['firstname' => User::find(Auth::user()->id)->firstname]);
                                     session(['name' => Auth::user()->name]);
                                     session(['id' => Auth::user()->id]);
                             }


            $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`> CURRENT_DATE ORDER BY `sors`.`dat`');
            $particips = DB::select('SELECT sorty.particips.id AS participsid,`particips`.*, `users`.*, `sors`.* FROM `particips` LEFT JOIN `users` ON `particips`.`user_id` = `users`.`id` LEFT JOIN `sors` ON `particips`.`sor_id` = `sors`.`id` WHERE `sors`.`dat`> CURRENT_DATE ORDER BY `sors`.`dat` , `particips`.`inscription` ASC');
            $today=Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL');
            $users=User::all();

             return view('participindex',['today' => $today,'particips'=> $particips,'users' => $users,'sors' => $sors]);

            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
 if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
        $users=User::orderBy('name','Asc')->get();
        $particips=Particip::all();
       $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`> CURRENT_DATE ORDER BY `sors`.`dat`');
        return view('partcreate',['users' => $users,'sors' => $sors,'particips'=>$particips]);
    }


    public function cree2()
    {
          if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
          if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
        $particips=Particip::all();
        $users=User::orderBy('name','Asc')->get();
        $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`> CURRENT_DATE ORDER BY `sors`.`dat`');
        return view('participcreate',['particips'=>$particips,'users' => $users,'sors' => $sors]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
{
    Particip::create($request->all());
//Redirect ('/home')->with('success', 'votre sortie est enregistrée');
   return Redirect::to('/home')->with('success', 'votre sortie est enregistrée');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function show(Particip $particip)
{

    $date=date_create("$particip->created_at");
    $date1=Sor::find($particip->sor_id )->dat;
    $date2 =date('d-m-Y', strtotime($date1));
    $user=User::find($particip->user_id );
    echo 'date d inscription : ' .date_format($date,"d-m-Y").'<br>';
    echo 'sortie du  ' .$date2 .'<br> participant : '. $user->name." ".$user->firstname.'<br>';
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function edit(Particip $particip)
    {

          if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
          if (session('role')<>('admin' or 'membre')) {return Redirect::to('/')->with('error', 'accès non autorisé');}

        $today=Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL');
        $sors=Sor::all()->sortBy('dat')->where('dat','>',Carbon::now());
        $user=User::find($particip->user_id);
        $sor2=Sor::find($particip->sor_id);
        return view('participedit', compact('particip','sors','user','sor2'));
    }


    public function update(Request $request, Particip $particip)
    {
        $particip->update($request->all());
        return Redirect::to('/home')->with('success', '    Sortie  modifiée');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Particip $particip)
        {
            $particip->delete();
            return Redirect::to('/home')->with('success', 'Participation  supprimée !');
        }

     public   function destroyForm(Particip $particip)
    {

if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
if (session('role')<>'admin' and session('id')<>$particip->user_id ){return Redirect::to('/')->with('error', 'accès non autorisé');}

$sors=Sor::find($particip->sor_id);

         if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
        return view('participdestroy', compact('particip'),compact('sors'));
    }

  public function partarchive()
    {
       $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`< CURRENT_DATE ORDER BY `sors`.`dat`');
       $particips = DB::select('SELECT sorty.particips.id AS participsid,`particips`.*, `users`.*, `sors`.* FROM `particips` LEFT JOIN `users` ON `particips`.`user_id` = `users`.`id` LEFT JOIN `sors` ON `particips`.`sor_id` = `sors`.`id` WHERE `sors`.`dat`< CURRENT_DATE ORDER BY `sors`.`dat` , `particips`.`inscription` ASC');
       $today=Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL');
       $users=User::all();

 return view('partarchive',['today' => $today,'particips'=> $particips,'users' => $users,'sors' => $sors]);

    }






}
