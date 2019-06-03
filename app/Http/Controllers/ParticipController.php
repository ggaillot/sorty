<?php

namespace App\Http\Controllers;


use App\Models\Particip;
use App\Models\User;
use App\Models\Sor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;


Date::setLocale('fr');




class ParticipController extends Controller
{
    /*******************************************************************************************/

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
            $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`>= CURRENT_DATE ORDER BY `sors`.`dat`');
            $particips = DB::select('SELECT particips.id AS participsid,`particips`.*, `users`.*, `sors`.* FROM `particips` LEFT JOIN `users` ON `particips`.`user_id` = `users`.`id` LEFT JOIN `sors` ON `particips`.`sor_id` = `sors`.`id` WHERE `sors`.`dat`>= CURRENT_DATE ORDER BY `sors`.`dat` , `particips`.`inscription` ASC');
            $today=Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL');
            $users=User::all();
             return view('participindex',['today' => $today,'particips'=> $particips,'users' => $users,'sors' => $sors]);
            }
    /*******************************************************************************************/

    public function create()
    {
 session(['creauser' => '/partcreate']);
        if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
 if (session('role')<>'membre'){return Redirect::to('/')->with('error', 'accès non autorisé');}
        $users=User::orderBy('name','Asc')->get();
        $particips=Particip::all();
       $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`>= CURRENT_DATE ORDER BY `sors`.`dat`');
        return view('partcreate',['users' => $users,'sors' => $sors,'particips'=>$particips]);
    }
    /*******************************************************************************************/

    public function cree2()
    {
        session(['creauser' => '/partcreate']);
          if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
          if (session('role')<>'admin' and (session('role')<>'superadmin')){return Redirect::to('/')->with('error', 'accès non autorisé');}
        $particips=Particip::all();
        $users=User::orderBy('name','Asc')->get();
        $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`>= CURRENT_DATE ORDER BY `sors`.`dat`');
        return view('participcreate',['particips'=>$particips,'users' => $users,'sors' => $sors]);
    }
    /*******************************************************************************************/

    public function store(Request $request)
    {
        // calcul de la date d'inscription des invité : 4 jours avant la date de sortie

        $iduser=$request->input('user_id');
        $idsor=$request->input('sor_id');

        $datsorty=Sor::find($idsor)->dat;
        $a=new Carbon($datsorty);

        $now = Carbon::now();
        $ecart=$a->diffInDays($now);
        $inscinvite=$a->subDays(4);


        if (User::find($iduser)->role=='invité' and $ecart>4)
                   {
                    Particip::create([
                                        'user_id' => $iduser,
                                        'sor_id' => $idsor,
                                        'comment_particip' => $request->input('comment_particip'),
                                        'inscription' => $inscinvite
                                    ]);
                   } else
                   {
                    Particip::create([
                                        'user_id' => $iduser,
                                        'sor_id' => $idsor,
                                        'comment_particip' => $request->input('comment_particip')
                                    ]);
                   }
        return Redirect::to('/home')->with('success', 'la  sortie est enregistrée  ');
    }

    /*******************************************************************************************/
        public function show(Particip $particip)
    {

        $date=date_create("$particip->created_at");
        $date1=Sor::find($particip->sor_id )->dat;
        $date2 =date('d-m-Y', strtotime($date1));
        $user=User::find($particip->user_id );
        echo 'date d inscription : ' .date_format($date,"d-m-Y").'<br>';
        echo 'sortie du  ' .$date2 .'<br> participant : '. $user->name." ".$user->firstname.'<br>';
    }
    /*******************************************************************************************/
        public function edit(Particip $particip)
    {
          if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
          if (session('role')<>('admin' or 'membre' or 'superadmin')) {return Redirect::to('/')->with('error', 'accès non autorisé');}
        $today=Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL');
        $sors=Sor::all()->sortBy('dat')->where('dat','>=',Carbon::now());
        $user=User::find($particip->user_id);
        $sor2=Sor::find($particip->sor_id);
        return view('participedit', compact('particip','sors','user','sor2'));
    }
    /*******************************************************************************************/

    public function update(Request $request, Particip $particip)
    {
        $particip->update($request->all());
        return Redirect::to(session('origine'))->with('success', '    Sortie  modifiée');
    }
    /*******************************************************************************************/

    public function destroy(Particip $particip)
        {
            if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
//recherche date sortie
$idsorty=$particip->sor_id;
$idparticip=$particip->id;
$sor=Sor::find($idsorty);
$datsorty=$sor->dat;
$sortyname=Date::parse($datsorty)->format('l j F  ').' / sortie '.$sor->typ;
//nb d'heures avant la sortie (pas de desinscription h-24)
$a=new Carbon($datsorty);
$now = Carbon::now();
$ecart=$a->diffInHours($now)+5;
//id des participants à la sortie
//ORDRE  $ordre[n°] donne le rang

$idparticipants=Particip::where('sor_id',$idsorty)->orderBy('inscription', 'asc');
$idpars=$idparticipants->get();
$x=0;
foreach ($idpars as $idpar) {
  $x=$x+1;
$ordre[$idpar->id]=$x;
$tri[$x]=$idpar->id;
}

//nb de participants
$nb= $idparticipants->count();
//premier en liste d'attente// note : last() ne fonctionne pas
if ($nb>8){
            $user9=Particip::find($tri[9])->user_id;
            $user=User::find($user9);
            $name9=$user->firstname.' '.$user->name;
            $email9=$user->email;
            $attente =$name9.' / tel : '.$user->tel.' / '.$email9;
          }


$text1='';
if ($nb==5 and $ecart<25 and session('role')<>'admin' and session('role')<>'superadmin' ){ return Redirect::to(session('origine'))->with('error', 'Vous ne pouvez pas vous désinscrire '.$ecart.' heures avant la sortie. Elle pourra ainsi avoir lieu et les autres participants ne seront pas pénalisés. Trouvez un remplaçant : après son inscription, vous pourrez annuler votre participation.                     Si vous êtes noté absent, vous devrez payer la sortie.');}
if ($nb>8 and $ordre[$idparticip]<9){$text1="Prévenez---- ".$attente." ---- ce membre a intégré la sortie !!! merci !!!";

//*************************************************************************

// envoi mail integration dans la liste des participants à la sortie
        $title = 'integration à la sortie du '.$sortyname;
        $content = "sortie parapangue";
        $data = ['subject' => $title, 'content' => $content];
        $text = '<H3>Sortie du '.$sortyname.'</H3> <br><br><b> '.$name9.'</b><br>Suite à une désinscription, vous faites désormais partie des participants à la sortie Parapangue <br><font color=blue><b>du '.$sortyname.' </font></b><br><br>Bons vols ... <br><br>     http://sorties.16mb.com/';
        $emails=array($email9,'gaillot.gege@gmail.com');
        session(['text' => $text]);
// envoi du mail basé sur la vue send2
        Mail::send('mail/send2', $data, function($message) use($emails, $data)
                    {
                        $subject=$data['subject'];
                        $message->from('sortie@parapangue.re');
                        $message->to($emails);
                        $message->subject($subject);
                    });
                                    }
// effacement
            $particip->delete();
            return Redirect::to(session('origine'))->with('success', 'Participation  supprimée ! '.$text1);
           // return Redirect::to('/home')->with('success', 'Participation  supprimée !');
        }
    /*******************************************************************************************/

     public   function destroyForm(Particip $particip)
    {

    if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
    if ((session('role')<>'admin' and (session('role')<>'superadmin')) and session('id')<>$particip->user_id ){return Redirect::to('/')->with('error', 'accès non autorisé');}

    $sors=Sor::find($particip->sor_id);
    $users=User::find($particip->user_id);
         if (is_null(Auth::user())){return Redirect::to('/login')->with('error', 'connexion nécessaire');}
        return view('participdestroy',['particip'=> $particip,'users' => $users,'sors' => $sors]);
    }
    /*******************************************************************************************/

  public function partarchive()
    {
       $sors=DB::select('SELECT `sors`.* FROM `sors` WHERE `sors`.`dat`< CURRENT_DATE ORDER BY `sors`.`dat` DESC');
       $particips = DB::select('SELECT particips.id AS participsid,`particips`.*, `users`.*, `sors`.* FROM `particips` LEFT JOIN `users` ON `particips`.`user_id` = `users`.`id` LEFT JOIN `sors` ON `particips`.`sor_id` = `sors`.`id` WHERE `sors`.`dat`< CURRENT_DATE ORDER BY `sors`.`dat` , `particips`.`inscription` ASC');
       $today=Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL');
       $users=User::all();

 return view('partarchive',['today' => $today,'particips'=> $particips,'users' => $users,'sors' => $sors]);

    }

    /*******************************************************************************************/

}
