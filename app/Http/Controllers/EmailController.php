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
         $sors->commentmail=$sors->comment_sor;
         $sors->save();
        //$particips=DB::select('SELECT sorty.sors.*, sorty.sors.id AS id3, sorty.particips.*, sorty.users.*, sorty.particips.id AS id1, sorty.users.id AS id2, sorty.particips.sor_id AS sor_id1 FROM sorty.sors INNER JOIN sorty.particips ON sorty.particips.sor_id = sorty.sors.id INNER JOIN sorty.users ON sorty.particips.user_id = sorty.users.id WHERE sorty.particips.sor_id = "'.$idsor.'"');
            $particips=DB::select('SELECT sors.*, sors.id AS id3, particips.*, users.*, particips.id AS id1, users.id AS id2, particips.sor_id AS sor_id1 FROM sors INNER JOIN particips ON particips.sor_id = sors.id INNER JOIN users ON particips.user_id = users.id WHERE particips.sor_id = "'.$idsor.'"ORDER BY inscription ASC');
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
        $text = $request->input('commentmail');
       // $email = $request->input('email');
        $id = $request->input('id');
        $particips=DB::select('SELECT sors.*, sors.id AS id3, particips.*, users.*, particips.id AS id1, users.id AS id2, particips.sor_id AS sor_id1 FROM sors INNER JOIN particips ON particips.sor_id = sors.id INNER JOIN users ON particips.user_id = users.id WHERE particips.sor_id = "'.$id.'" ORDER BY inscription ASC');

        $x=0;
        foreach ($particips as $particip) {
                                            $x=$x+1;

                                            $mail=$particip->email;
                                            if($x==1){$email=array($mail);}else{array_push($email, $mail);}
                                           }
        array_push($email, 'gaillot.gege@gmail.com');
        array_push($email, 'sorties@parapangue.re');array_push($email, 'franck.ford@hotmail.fr');array_push($email, 'p_kilian@yahoo.fr');array_push($email, 'jacques.aulet@wanadoo.fr');
        $emails=$email;
        session(['title' => $title]);
        session(['comment' => $comment]);
        session(['text' => $text]);
        session(['email' => $email]);
        $content = "sortie parapangue";
        $user_name = "sortie parapangue";
        //$emails = ['test1@hotmail.com','test2@hotmail.com','test3@hotmail.com'];
        //$data = ['email'=> $user_email,'name'=> $user_name,'subject' => $title, 'content' => $content];
        $data = ['subject' => $title, 'content' => $content];
         // envoi du mail basé sur la vue send2
        Mail::send('mail/send2', $data, function($message) use($emails, $data)
                    {
                        $subject=$data['subject'];
                        $message->from('sorties@parapangue.re');
                        $message->to($emails);
                        $message->subject($subject);
                        //$message->from($address, $name = null);
                        //$message->sender($address, $name = null);
                        //$message->to($address, $name = null);
                        //$message->cc($address, $name = null);
                        //$message->bcc($address, $name = null);
                        //$message->replyTo($address, $name = null);
                        //$message->subject($subject);
                        //$message->attach($pathToFile, array $options = []);
                    });

        // marque 'email envoyé' par xxxx
        $sor=Sor::find($id);
        $sor->email=1;
        $sor->autemail=session('firstname')." ".session('name');
        $sor->commentmail=session('text');
        $sor->datemail=now();
        $sor->save();
                    return Redirect::to('/home')->with('success', 'courriel envoyé par '.session('firstname')." ".session('name'));
             }
           // }
}
