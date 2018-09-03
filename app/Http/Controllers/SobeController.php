<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soba;
use App\Rezervacija;
use Carbon\Carbon;

class SobeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sobe = Soba::All();
        $jednokrevetne = Soba::where('brkreveta','1')->count();
        $dvokrevetne = Soba::where('brkreveta','2')->count();
        $trokrevetne = Soba::where('brkreveta','3')->count();

        return view('soba.pregled_soba',compact('sobe','jednokrevetne','dvokrevetne','trokrevetne'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('soba.dodaj_sobu');
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
        $room = new Soba;

        $request->validate([
            'naziv' => 'required|unique:sobe|min:5',
            'opis' => 'required',
            'brojKr' => 'required',
            'balkon' => 'required',
            //'status' => 'required'
        ]);
        

        $room->naziv = $request->get('naziv');
        $room->opis = $request->get('opis');

        $kreveti = $request->get('brojKr');
        $room->brkreveta = $kreveti;

        $balk = $request->get('balkon');
        if($balk == 'DA')
        {
            $room->balkon = '1';
        }
        else
            $room->balkon = '0';

        $room->status = '0';
        $room->cistoca = '1';

        if($kreveti == 1)
        {
            $room->cijena_nocenja = 50;
        }
        else if($kreveti == 2)
        {
            $room->cijena_nocenja = 75;
        }
        else
            $room->cijena_nocenja = 100;

        $room->save();

        session()->flash('spremanje','Soba uspješno pohranjena!');

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
        $soba = Soba::findOrFail($id);
        $rezervacija = Rezervacija::where('id_sobe',$soba->id)->latest()->first();

        date_default_timezone_set('Europe/Sarajevo');
        $krajRez = Carbon::parse($rezervacija->datum_do)->format('d-m-Y H:i:s');
        return view('soba.detalji_sobe',compact('soba','rezervacija','krajRez'));
    }

    /**
     * Clean the selected room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clean($id)
    {
        //
        $room = Soba::findOrFail($id);
        $room->cistoca = '1';
        $room -> save();
        session()->flash('spremanje','Soba očišćena!');

        return back();
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
        $room = Soba::findOrFail($id);
        return view('soba.izmjena_podataka',compact('room'));

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
        $room = Soba::findOrFail($id)->where('status','0')->first();
        $request->validate([
            'naziv' => 'required|min:5',
            'opis' => 'required',
            'brojKr' => 'required',
            'cijena' => 'required',
        ]);
        $room->naziv = $request->get('naziv');
        $room->opis = $request->get('opis');

        $kreveti = $request->get('brojKr');
        $room->brkreveta = $kreveti;
        
        $room->cijena_nocenja = $request->get('cijena');

        $room->save();

        session()->flash('spremanje','Soba uspješno pohranjena!');

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
        $room = Soba::findOrFail($id);
        if($room->status == '1')
        {
            $room->delete();
            return back();
        }
        else
            return back();
        
    }
}
