@extends('layouts.app')

@section('content')
<div id="main" class="container bg-light rounded shadow">
    <h2 class="text-center">SUSTAV ZA ADMINISTRACIJU HOTELSKOG SMJEŠTAJA<br><br></h2>
    <div class="row">
        <div class="col-sm-4 prvi" align="center">
            <div class="card shadow" style="width: 20rem;">
                <img class="card-img-top" src="{{url('images/soba.jpg')}}" alt="Card image cap">
                <div class="card-body text-center">
                    <p class="card-text lead font-weight-bold">Pregled, dodavanje i održavanje soba.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 drugi" align="center">
            <div class="card shadow" style="width: 20rem;">
                <img class="card-img-top" src="{{url('images/rezervacija.jpg')}}" alt="Card image cap">
                <div class="card-body text-center">
                    <p class="card-text lead font-weight-bold">Stvaranje, otkazivanje rezervacija, te stvaranje i ispisivanje računa za završene rezervacije.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 treci" align="center">
            <div class="card shadow" style="width: 20rem;">
                <img class="card-img-top" src="{{url('images/notification.jpg')}}" alt="Card image cap">
                <div class="card-body text-center">
                    <p class="card-text lead font-weight-bold">Stvaranje, pregled, te brisanje napomena osoblju.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
