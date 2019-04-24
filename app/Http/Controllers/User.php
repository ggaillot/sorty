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
    public function index()

    {
         if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}

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
    public function create()
    {

         if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
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
    User::create($request->all());

    return Redirect::to('/users')->with('success', 'utilisateur enregistré');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function show(User $user)
{
     if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
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
         if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
        return view('edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

         return redirect ('users')->with('success', 'fiche de '.$user->firstname." ".$user->name." modifiée " );
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
      public function destroy(User $user)
        {
$particips=Particip::all();
            $user->delete();
            return redirect ('users')->with('success', 'fiche de '.$user->firstname." ".$user->name." supprimée " );
        }

        public function destroyForm(User $user)
    {
         if (session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
        return view('destroy', compact('user'));
    }




}
