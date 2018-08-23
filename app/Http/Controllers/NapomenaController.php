<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Napomena;
use Auth;
use Carbon\Carbon;

class NapomenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $napomene = Napomena::paginate(10);
        Carbon::setLocale('hr');

        return view('napomena.napomene')->with('napomene',$napomene);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('napomena.stvori_napomenu');
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
        $nap = new Napomena;

        $request->validate([
            'naslov' => 'required',
            'tekst' => 'required'
        ]);

        $nap->naslov = $request->get('naslov');
        $nap->sadrzaj = $request->get('tekst');
        $nap->id_korisnika = Auth::user()->id;
        $nap->procitana = 0;
        $nap->save();

        session()->flash('spremanje','Napomena uspješno pohranjena!');

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
        $napomena = Napomena::findOrFail($id);
        $napomena->procitana = '1';
        $napomena->save();
        
        return view('napomena.pregled_napomene',compact('napomena'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $napomena = Napomena::findOrFail($id);
        $napomena->procitana = '1';

        $napomena->save();
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
        $napomena = Napomena::findOrFail($id);
        $napomena -> delete();
        
        return back();
    }
}
