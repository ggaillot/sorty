<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Models\Particip;
use App\Models\User;
use App\Models\Sor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
Date::setLocale('fr');

class EmailController extends Controller
{
    //afficher vue brouillon message
    function show()
    {
        $idsor=request('send');
        $sors=Sor::find($idsor);
            $particips=DB::select('SELECT sorty.sors.*, sorty.sors.id AS id3, sorty.particips.*, sorty.users.*, sorty.particips.id AS id1, sorty.users.id AS id2, sorty.particips.sor_id AS sor_id1 FROM sorty.sors INNER JOIN sorty.particips ON sorty.particips.sor_id = sorty.sors.id INNER JOIN sorty.users ON sorty.particips.user_id = sorty.users.id WHERE sorty.particips.sor_id = "'.$idsor.'"');
             return view('mail/send',['particips'=> $particips,'sors' => $sors]);
            foreach ($particips as $particip) {
                                                echo $particip->id;
                                               }
    }

public function update(request $request)

    {
        $title = $request->input('title');
        $content = $request->input('comment');
        $comment = $request->input('comment');
        $text = $request->input('text');
       // $email = $request->input('email');
         $id = $request->input('id');

  $particips=DB::select('SELECT sorty.sors.*, sorty.sors.id AS id3, sorty.particips.*, sorty.users.*, sorty.particips.id AS id1, sorty.users.id AS id2, sorty.particips.sor_id AS sor_id1 FROM sorty.sors INNER JOIN sorty.particips ON sorty.particips.sor_id = sorty.sors.id INNER JOIN sorty.users ON sorty.particips.user_id = sorty.users.id WHERE sorty.particips.sor_id = "'.$id.'"');

$x=0;
foreach ($particips as $particip) {
$x=$x+1;
$mail=$particip->email;
if($x==1){$email=array($mail);}else{array_push($email, $mail);}
}
$emails=$email;

session(['title' => $title]);
session(['comment' => $comment]);
session(['text' => $text]);
session(['email' => $email]);
        $content = "sortie parapangue";
        $user_email = "cdparapangue.fr";
        $user_name = "sortie parapangue";
//$emails = ['test1@hotmail.com','test2@hotmail.com','test3@hotmail.com'];
//  $data = ['email'=> $user_email,'name'=> $user_name,'subject' => $title, 'content' => $content];
            $data = ['subject' => $title, 'content' => $content];
            Mail::send('mail/send2', $data, function($message) use($emails, $data)
            {
                $subject=$data['subject'];
                $message->from('info@test.ch');
                $message->to($emails);
                $message->to('test@test.fr');
                $message->subject($subject);
                //$message->from($address, $name = null);
//$message->sender($address, $name = null);
//$message->to($address, $name = null);
//$message->cc($address, $name = null);
//$message->bcc($address, $name = null);
//$message->replyTo($address, $name = null);
//$message->subject($subject);
//$message->priority($level);
//$message->attach($pathToFile, array $options = []);
            });
            return Redirect::to('/home')->with('success', 'votre email est envoyé');
     }
   // }
}
