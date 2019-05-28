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


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //

    {
        session(['creauser' => 'users']);
         if (session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}

         $users=User::orderBy('name','Asc')->get();
         return view('usersindex',compact('users'));
        //$user=User::find(1);
        // return view('usersindex',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    public function create()
    {

         if (session('role')<>'admin' and session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
         return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
{
    $mail= $request->input('email');
    $countemail=User::where('email',$mail)->count();
    if ($countemail>0 ){return Redirect::to(session('creauser'))->with('error', 'le mail '.$mail.' est déjà présent ');  }
    User::create($request->all());
return Redirect::to(session('creauser'))->with('success', 'utilisateur enregistré ');

   // return Redirect::to('/users')->with('success', 'utilisateur enregistré');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function show(User $user)
{
     if (session('role')<>'admin' and session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
    echo 'Nom :' . $user->name . '<br>';
    echo 'Email :' . $user->email . '<br>';
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function edit(User $user)
    {
         if (session('role')<>'admin' and session('role')<>'superadmin' ){return Redirect::to('/')->with('error', 'accès non autorisé');}
        return view('edit', compact('user'));

    }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
         return redirect ('users')->with('success', 'fiche de '.$user->firstname." ".$user->name." modifiée " );
    }





    public function update2(Request $request, User $user)
    {
       $password = bcrypt($request->input('password'));
       $user->password=$password;
       $user->save();

       return redirect ('users2')->with('success', 'MOT DE PASSE de '.$user->firstname." ".$user->name." modifiée " );
    }






      public function destroy(User $user)
        {
$particips=Particip::all();
            $user->delete();
            return redirect ('users')->with('success', 'fiche de '.$user->firstname." ".$user->name." supprimée " );
        }

        public function destroyForm(User $user)
    {
         if (session('role')<>'admin' and session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
        return view('destroy', compact('user'));
    }

public function list()
{

    if (session('role')<>'admin' and session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
    $users=User::orderBy('name','Asc')->get();
return view('userslist', compact('users'));

}


public function index2()
{

 if (session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}

         $users=User::orderBy('name','Asc')->get();
         return view('usersindex2',compact('users'));

}
    public function create()
    {
         return view('create');
    }




}
