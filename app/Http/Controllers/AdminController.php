<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Soba;
use App\Napomena;
use App\Rezervacija;
use Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    //
   
    public function index()
    {   
        date_default_timezone_set('Europe/Sarajevo');
        Carbon::setLocale('hr');
        $rezervacije = Rezervacija::whereDate('created_at', Carbon::today())->get();
        $napomene = Napomena::whereDate('created_at', Carbon::today())->get();
        $brSoba = Soba::where('status','0')->count();
        $brKorisnika = User::count();
        $brNapomena = Napomena::count();
        $brojZ = Rezervacija::where('zavrsena','0')->count();

        //varijable za graf1
        $jednokrevetne = Soba::where('brkreveta','1')->count();
        $dvokrevetne = Soba::where('brkreveta','2')->count();
        $trokrevetne = Soba::where('brkreveta','3')->count();
       

        //varijable za graf2
        $regular = User::where('isregular','1')->where('isadmin','0')->count();
        $admin = User::where('isregular','0')->where('isadmin','1')->count();
        $super = User::where('isregular','1')->where('isadmin','1')->count();
    

        return view('administracija.administration',compact('brSoba','brKorisnika','brNapomena','brojZ','rezervacije','napomene','jednokrevetne', 'dvokrevetne','trokrevetne','regular','admin','super'));
    }


    public function pohraniKorisnika(Request $request)
    {
        //
        $usr = new User;

        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
        ]);

        $usr->name = $request->input('name');
        $usr->email = $request->input('email');

        $rola = $request->input('role');
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

        $usr->password = bcrypt($request->input('password'));
       
        $usr->save();

        return back();
    }

    public function profit()
    {
        $rezervacije = Rezervacija::where('iznos','>','0')->get();
        return view('administracija.profit',compact('rezervacije'));
    }

    public function prikaziOP()
    {
        return view('administracija.osobne_postavke');
    }

    public function izmjenaPodataka(Request $request, $id)
    {
        $this->validate(request(),[
            'ime' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('ime');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('lozinka'));
        $user->save();

        session()->flash('spremanje','Uspješna izmjena podataka!');
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function report()
    {   
        Carbon::setLocale('hr');
        date_default_timezone_set('Europe/Sarajevo');
        $datum = Carbon::now()->format('d/m/Y');
        $vrijeme = Carbon::now()->format('d-m-Y H:i:s');
        $korisnici = User::whereDate('created_at', Carbon::today())->count();
        $rezervacije = Rezervacija::whereDate('created_at', Carbon::today())->count();
        $napomene = Napomena::whereDate('created_at', Carbon::today())->count();
        $brSlobSoba = (Soba::count()) - (Soba::where('status','1')->count());
        $brSoba = Soba::count();
        
        return view('administracija.dnevni_izvjestaj',compact('datum','vrijeme','korisnici', 'rezervacije', 'napomene','brSlobSoba','brSoba'));
    }

    
}
