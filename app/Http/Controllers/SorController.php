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

class SorController extends Controller
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public function index()
    {
    $sors = Sor::orderBy('dat','Desc')->get();
    if (session('role')<>'admin' and session('role')<>'superadmin'){return Redirect::to('/')->with('error', 'accès non autorisé');}
    return view('sorsindex',compact('sors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('sorcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
{
    Sor::create($request->all());

   return Redirect::to('/sors')->with('success', 'votre sortie est enregistrée');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function show(Sor $sor)
{

    $date=date_create("$sor->dat");
    echo 'date : ' .date_format($date,"d-m-Y").'<br>';
    echo 'sortie ' . $sor->typ . '<br>';
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function edit(Sor $sor)
    {
        return view('soredit', compact('sor'));
    }
    public function update(Request $request, Sor $sor)
    {
        $sor->update($request->all());
        return Redirect::to(session('origine'))->with('success', 'votre sortie est modifiée');

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
      public function destroy(Sor $sor)
        {
            $sor->delete();
           return Redirect::to('/sors')->with('success', 'votre sortie est supprimée');
        }

        public function destroyForm(Sor $sor)
    {
        return view('sordestroy', compact('sor'));
    }
}
