@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>PREGLED REZERVACIJA</h1>
</div>
@endsection
@section('content')
<div class="container">
<ul class="nav nav-tabs" id="myTab" role="tablist" style="font-weight:bold;">
  <li class="nav-item">
    <a class="nav-link active bg-info" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Aktivne</a>
  </li>&nbsp;
  <li class="nav-item">
    <a class="nav-link bg-success" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Završene</a>
  </li>
</ul>
</div><br>
<div class="tab-content" id="myTabContent">
<!--Aktivne Rezervacije-->
<div class="container tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <br>
  <table class="table table-responsive tablesorter table-hover" align="center">
    <thead class="bg-secondary">
      <tr>
        <th>Ime i Prezime Klijenta <i class="fa fa-sort"></i></th>
        <th>Naziv Sobe <i class="fa fa-sort"></i></th>
        <th>Broj Kreveta <i class="fa fa-sort"></i></th>
        <th>Korisnik koji je stvorio rezervaciju <i class="fa fa-sort"></i></th>
        <th>Doručak (DA/NE) <i class="fa fa-sort"></i></th>
        <th>Vrijeme Početka <i class="fa fa-sort"></i></th>
        <th>Vrijeme Završetka <i class="fa fa-sort"></i></th>
        <th>Radnja</th>
      </tr>
    </thead>
    <tbody id="myTable">
    @forelse($reservations as $rezervacija)
    @if($rezervacija->zavrsena == 0)
      <tr>
        <td>{{ $rezervacija->ime }} {{ $rezervacija->prezime }}</td>
        <td>{{ $rezervacija->soba->naziv }}</td>
        <td>{{ $rezervacija->soba->brkreveta }}</td>
        <td>{{ $rezervacija->user->name }}</td>
        <td>{{ $rezervacija->dorucak == '1' ? 'DA' : 'NE' }}</td>
        <td class="{{ $rezervacija->zavrsena == '1' ? 'table-warning' : ''}}">{{ $rezervacija->datum_od }}</td>
        <td class="{{ $rezervacija->zavrsena == '1' ? 'table-warning' : ''}}">{{ $rezervacija->datum_do }}</td>
        <td>
          @if($rezervacija->zavrsena == 0 && $rezervacija->naplacena == 0)
          <a onclick="return confirm('Da li ste sigurni?')" href="{{ url('/admin/rezervacije/otkaz/')}}/{{ $rezervacija->id }}" class="btn btn-danger {{$rezervacija->zavrsena ? 'disabled':''}} btn-sm">Otkaži <i class="fa fa-ban"></i></a>&nbsp;
          <a href="{{ url('/admin/rezervacije/izmjena_rez/')}}/{{ $rezervacija->id }}" class="btn btn-secondary {{$rezervacija->zavrsena ? 'disabled':''}} btn-sm">Izmjena <i class="fa fa-edit"></i></a>&nbsp;
          @endif
        </td>
      </tr>
    @endif
    @empty
      <p>Trenutno nema rezervacija</p>
    @endforelse
    </tbody>
  </table>
  @if(session()->has('brisanje'))
              
              <div class="alert alert-danger">
                  <strong>{{session()->get('brisanje')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
              </div>
                  
@endif
</div>
<!-- -->

<!--Završene Rezervacije-->
<div class="container tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <br>
  <table class="table table-responsive tablesorter table-hover" align="center">
    <thead class="bg-secondary">
      <tr>
        <th>Ime i Prezime Klijenta <i class="fa fa-sort"></i></th>
        <th>Naziv Sobe <i class="fa fa-sort"></i></th>
        <th>Broj Kreveta <i class="fa fa-sort"></i></th>
        <th>Korisnik koji je stvorio rezervaciju <i class="fa fa-sort"></i></th>
        <th>Doručak (DA/NE) <i class="fa fa-sort"></i></th>
        <th>Vrijeme Početka <i class="fa fa-sort"></i></th>
        <th>Vrijeme Završetka <i class="fa fa-sort"></i></th>
        <th>Iznos Računa <i class="fa fa-money"></i></th>
        <th>Radnja</th>
      </tr>
    </thead>
    <tbody id="myTable">
    @forelse($reservations as $rezervacija)
    @if($rezervacija->zavrsena == 1)
      <tr>
        <td>{{ $rezervacija->ime }} {{ $rezervacija->prezime }}</td>
        <td>{{ $rezervacija->soba->naziv }}</td>
        <td>{{ $rezervacija->soba->brkreveta }}</td>
        <td>{{ $rezervacija->user->name }}</td>
        <td>{{ $rezervacija->dorucak == '1' ? 'DA' : 'NE' }}</td>
        <td class="{{ $rezervacija->zavrsena == '1' ? 'table-warning' : ''}}">{{ $rezervacija->datum_od }}</td>
        <td class="{{ $rezervacija->zavrsena == '1' ? 'table-warning' : ''}}">{{ $rezervacija->datum_do }}</td>
        <td>{{ $rezervacija->iznos }} BAM</td>
        <td>
          @if($rezervacija->zavrsena == 0 && $rezervacija->naplacena == 0)
          <a onclick="return confirm('Da li ste sigurni?')" href="{{ url('/admin/rezervacije/otkaz/')}}/{{ $rezervacija->id }}" class="btn btn-danger {{$rezervacija->zavrsena ? 'disabled':''}} btn-sm">Otkaži <i class="fa fa-ban"></i></a>&nbsp;
          <a href="{{ url('/admin/rezervacije/izmjena_rez/')}}/{{ $rezervacija->id }}" class="btn btn-secondary {{$rezervacija->zavrsena ? 'disabled':''}} btn-sm">Izmjena <i class="fa fa-edit"></i></a>&nbsp;
          @endif

          @if($rezervacija->zavrsena == '1' && $rezervacija->naplacena == '0')
          <a onclick="return confirm('Da li ste sigurni?')" href="{{ url('/admin/rezervacije/zavrsi/')}}/{{ $rezervacija->id }}" class="btn btn-info btn-sm">Završi <i class="fa fa-credit-card"></i></a>&nbsp;
          @endif
    
          @if($rezervacija->naplacena)
          <form method="post" action="{{ url('/admin/rezervacije/ukloni/')}}/{{ $rezervacija->id }}">
            @csrf
            {{ method_field('delete') }}
          <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-warning btn-sm">Ukloni <i class="fa fa-trash"></i></button>
          </form>
          @endif
        </td>
      </tr>
    @endif
    @empty
      <p>Trenutno nema rezervacija</p>
    @endforelse
    </tbody>
  </table>
</div>
</div>

<!-- -->
@endsection