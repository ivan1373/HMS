<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rezervacija;
use App\Soba;
use App\Napomena;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
        $users = User::All();

        return view('korisnik.pregled_zaposlenika',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('korisnik.dodaj_korisnika');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usr = new User;

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $usr->name = $request->get('name');
        $usr->email = $request->get('email');

        $rola = $request->get('role');
        if($rola == 'Recepcioner')
        {
            $usr->isregular = '1';
            $usr->isadmin = '0';
        }
        else
        {
            $usr->isregular = '0';
            $usr->isadmin = '1';
        }

        $usr->password = bcrypt($request->get('password'));
       
        $usr->save();

        session()->flash('spremanje','Korisnik uspješno pohranjen!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        date_default_timezone_set('Europe/Sarajevo');
        Carbon::setLocale('hr');
        $user = User::findOrFail($id);
        $brRez = Rezervacija::where('id_korisnika',$user->id)->count();
        $brNapomena = Napomena::where('id_korisnika',$user->id)->count();
        $napomene = Napomena::where('id_korisnika',$user->id)->get();

        return view('korisnik.detalji_korisnika',compact('user','brRez','brNapomena','napomene'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        /*$user = User::findOrFail($id);
        return view('korisnik.uredi_podatke',compact('user'));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(),[
            'ime' => 'required',
            'email' => 'required'
           // 'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('ime');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $rola = $request->get('role');
        if($rola == 'Standardni')
        {
            $user->isregular = '1';
            $user->isadmin = '0';
        }
        else if($rola == 'Administrator')
        {
            $user->isregular = '0';
            $user->isadmin = '1';
        }
        else{
            $user->isregular = '1';
            $user->isadmin = '1';
        }
        $user->save();

        session()->flash('spremanje','Uspješno izmijenjeni korisnički podaci!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user -> delete();
        
        return back();
    }
}
