<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UserController_a_supprimer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('participindex',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

    return "Utilisateur créé !";
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function show(User $user)
{
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
        return view('edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return "Utilisateur modifié !";
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
            $user->delete();
            return 'Utilisateur supprimé !';
        }

        public function destroyForm(User $user)
    {
        return view('destroy', compact('user'));
    }
}
