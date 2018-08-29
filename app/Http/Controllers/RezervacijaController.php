<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rezervacija;
use App\Soba;
use Auth;
use Carbon\Carbon;

class RezervacijaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Rezervacija::orderBy('datum_do','desc')->get();
        //$reservations = Rezervacija::sortable()->paginate(5);
        foreach($reservations as $reservation)
        {
            $reservation->datum_od=Carbon::parse($reservation->datum_od)->format('d-m-Y H:i:s');
            $reservation->datum_do=Carbon::parse($reservation->datum_do)->format('d-m-Y H:i:s');
        }
        return view('rezervacija.rezervacije',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sobe = Soba::where('status', 0)->get();

        return view('rezervacija.rezerviraj_sobu',compact('sobe'));
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
        $rez = new Rezervacija;

        $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
            'datum-od' => 'required',
            'datum-do' => 'required|after:datum-od',
        ]);


        $rez->ime = $request->get('ime');
        $rez->prezime = $request->get('prezime');
        $rez->id_sobe = $request->get('id_sobe');
        $rez->id_korisnika = Auth::user()->id;

        $dorucak = $request->get('dorucak');
        if($dorucak == 'DA')
        {
            $rez->dorucak = '1';
        }
        else
            $rez->dorucak = '0';

        $rez->datum_od = $request->get('datum-od');
        $rez->datum_do = $request->get('datum-do');

        $rez->zavrsena = '0';
        $rez->naplacena = '0';
        $rez->iznos = 0;

        $rez->save();

        $idSobe = $request->get('id_sobe');
        $soba = Soba::findOrFail($idSobe);
        $soba->status = '1';
        $soba->save();
        
        session()->flash('spremanje','Rezervacija uspješno pohranjena!');

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
        $rezervacija = Rezervacija::findOrFail($id);
        return view('rezervacija.izmjena_rezervacije',compact('rezervacija'));
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
        $rezervacija = Rezervacija::findOrFail($id);

        $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
        ]);

        
        $rezervacija->ime = $request->get('ime');
        $rezervacija->prezime = $request->get('prezime');
        $rezervacija->save();

        session()->flash('spremanje','Rezervacija uspješno izmijenjena!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cancel($id)
    {
        $rezervacija = Rezervacija::where('zavrsena','0')->findOrFail($id);

        $room_id = $rezervacija->id_sobe;

        $soba = Soba::where('id', $room_id)->first();
        $soba->status = '0';
        date_default_timezone_set('Europe/Sarajevo');
        $danas = Carbon::now();
        if($danas >= Carbon::parse($rezervacija->datum_od))
        {
            $soba->cistoca = '0';
        }

        $soba->save();

        $rezervacija->delete();
        
        return back();
    }
    
    public function end($id)
    {
        $rezervacija = Rezervacija::where('zavrsena','1')->findOrFail($id);

        $room_id = $rezervacija->id_sobe;

        $soba = Soba::where('id', $room_id)->first();
        $soba->status = '0';
        $soba->cistoca = '0';
        $soba->save();
        
        date_default_timezone_set('Europe/Sarajevo');
        $danas = Carbon::now()->format('d-m-Y H:i:s');

        $pocetak = Carbon::parse($rezervacija->datum_od);
        $kraj = Carbon::parse($rezervacija->datum_do);

        $brojDana = $pocetak->diffInDays($kraj);
        $pdv = 0.17;

        $cijenaSobe = $soba->cijena_nocenja;

        $nocenje = $brojDana * $cijenaSobe;
        $dorucak = $brojDana * 7.5;

        $iznosBezPDV = $nocenje + $dorucak;

        $konacanIznos = $iznosBezPDV + ($iznosBezPDV * $pdv);
        $rezervacija->iznos = $konacanIznos;
        $rezervacija->naplacena = '1';
        
        $rezervacija->save();

        return view('rezervacija.izrada_racuna',compact('rezervacija','danas','brojDana','iznosBezPDV','cijenaSobe','nocenje','dorucak','konacanIznos'));

        return back();
    }

    public function destroy($id)
    {
        //
        $rezervacija = Rezervacija::where('naplacena','1')->findOrFail($id);
        $rezervacija -> delete();
        session()->flash('brisanje','Rezervacija uspješno uklonjena!');
        return back();
    }

}
