@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>PREGLED SOBA</h1>
</div>
@endsection
@section('content')
<div class="container text-center">
<ul class="nav nav-tabs" id="myTab" role="tablist" style="font-weight:bold;">
  <li class="nav-item">
    <a class="nav-link active bg-info" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Jednokrevetne</a>
  </li>&nbsp;
  <li class="nav-item">
    <a class="nav-link bg-secondary" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Dvokrevetne</a>
  </li>&nbsp;
  <li class="nav-item">
    <a class="nav-link bg-primary" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Trokrevetne</a>
  </li>
</ul>
</div><br><br>
<div class="tab-content" id="myTabContent">
<div class="container-fluid tab-pane fade show active"  id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="row">
  @if(session()->has('spremanje'))
            
              <div class="alert alert-success">
                  <strong>{{session()->get('spremanje')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
              </div>
           
  @endif
  </div>
  <div class="row">
  @foreach($sobe as $soba)
  @if($soba->brkreveta == 1)
    <div class="col-sm-4" align="center">
      <div class="card shadow" style="width: 20rem;">
        <img class="card-img-top" src="{{url('images/room_single.jpg')}}" alt="Card image cap">
          <div class="card-body {{ $soba->status == '1' ? 'bg-danger' : 'bg-success'}}">
            <h5 class="card-title">{{ $soba->naziv }}</h5>
            @if($soba->status == '1')
            <h3 class="text-white"><b>REZERVIRANA</b></h3>
            @else
            <h3 class="text-white"><b>SLOBODNA</b></h3>
            @endif
            <hr>
              <p class="card-text"><cite>{{ $soba->opis }}</cite></p>
              <p class="card-text">broj kreveta: &nbsp;<b>{{ $soba->brkreveta }}</b></p>
              <p class="card-text">balkon: &nbsp;<b>{{ $soba->balkon == '1' ? 'DA' : 'NE'}}</b></p>
              <p class="card-text">cijena noćenja: &nbsp;<b>{{ $soba->cijena_nocenja }} BAM</b></p>
              <p class="card-text">čista: &nbsp;<b>{{ $soba->cistoca == '1' ? 'DA' : 'NE'}}</b></p>
              <hr>
              <a href="{{ url('/admin/sobe/')}}/{{ $soba->id }}" class="btn btn-info" >Detalji <i class="fa fa-info"></i></a>&nbsp;
              <a href="{{ url('/admin/sobe/izmjena')}}/{{ $soba->id }}" class="btn btn-primary {{ $soba->status == '1' ? 'disabled' : ''}}" >Izmjena <i class="fa fa-cog"></i></a>
              <hr>
              <a href="{{ url('/admin/sobe/ociscena/')}}/{{ $soba->id }}" class="btn btn-secondary {{ $soba->cistoca == '1' ? 'disabled' : ''}}" >Očisti <i class="fa fa-leaf text-success"></i></a>&nbsp;
              <a onclick="return confirm('Da li ste sigurni?')" href="{{ url('/admin/sobe/brisi/')}}/{{ $soba->id }}" class="btn btn-warning {{ $soba->status == '1' ? 'disabled' : ''}}" >Izbriši <i class="fa fa-trash"></i></a>
          </div>
      </div>
    </div>
  @endif
  @endforeach
  </div>
  
</div>

<div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="container-fluid tab-pane fade">
  <div class="row">
  
  </div>
  <div class="row">
  @foreach($sobe as $soba)
  @if($soba->brkreveta == 2)
    <div class="col-sm-4" align="center">
      <div class="card shadow" style="width: 20rem;">
        <img class="card-img-top" src="{{url('images/room_double.jpg')}}" alt="Card image cap">
          <div class="card-body {{ $soba->status == '1' ? 'bg-danger' : 'bg-success'}}">
          <h5 class="card-title">{{ $soba->naziv }}</h5>
            @if($soba->status == '1')
            <h3 class="text-white"><b>REZERVIRANA</b></h3>
            @else
            <h3 class="text-white"><b>SLOBODNA</b></h3>
            @endif
            <hr>
              <p class="card-text"><cite>{{ $soba->opis }}</cite></p>
              <p class="card-text">broj kreveta: &nbsp;<b>{{ $soba->brkreveta }}</b></p>
              <p class="card-text">balkon: &nbsp;<b>{{ $soba->balkon == '1' ? 'DA' : 'NE'}}</b></p>
              <p class="card-text">cijena noćenja: &nbsp;<b>{{ $soba->cijena_nocenja }} BAM</b></p>
              <p class="card-text">čista: &nbsp;<b>{{ $soba->cistoca == '1' ? 'DA' : 'NE'}}</b></p><hr>
              <a href="{{ url('/admin/sobe/')}}/{{ $soba->id }}" class="btn btn-info" >Detalji <i class="fa fa-info"></i></a>&nbsp;
              <a href="{{ url('/admin/sobe/izmjena')}}/{{ $soba->id }}" class="btn btn-primary {{ $soba->status == '1' ? 'disabled' : ''}}" >Izmjena <i class="fa fa-cog"></i></a>
              <hr>
              <a href="{{ url('/admin/sobe/ociscena/')}}/{{ $soba->id }}" class="btn btn-secondary {{ $soba->cistoca == '1' ? 'disabled' : ''}}" >Očisti <i class="fa fa-leaf text-success"></i></a>&nbsp;
              <a onclick="return confirm('Da li ste sigurni?')" href="{{ url('/admin/sobe/brisi/')}}/{{ $soba->id }}" class="btn btn-warning {{ $soba->status == '1' ? 'disabled' : ''}}" >Izbriši <i class="fa fa-trash"></i></a>
          </div>
      </div>
    </div>
  @endif
  @endforeach
  </div>
</div>

<div id="contact" role="tabpanel" aria-labelledby="contact-tab" class="container-fluid tab-pane fade">
  <div class="row">
  
  </div>
  <div class="row">
  @foreach($sobe as $soba)
  @if($soba->brkreveta == 3)
    <div class="col-sm-4" align="center">
      <div class="card shadow" style="width: 20rem;">
        <img class="card-img-top" src="{{url('images/room_triple.jpg')}}" alt="Card image cap">
          <div class="card-body {{ $soba->status == '1' ? 'bg-danger' : 'bg-success'}}">
          <h5 class="card-title">{{ $soba->naziv }}</h5>
            @if($soba->status == '1')
            <h3 class="text-white"><b>REZERVIRANA</b></h3>
            @else
            <h3 class="text-white"><b>SLOBODNA</b></h3>
            @endif
            <hr>
              <p class="card-text"><cite>{{ $soba->opis }}</cite></p>
              <p class="card-text">broj kreveta: &nbsp;<b>{{ $soba->brkreveta }}</b></p>
              <p class="card-text">balkon: &nbsp;<b>{{ $soba->balkon == '1' ? 'DA' : 'NE'}}</b></p>
              <p class="card-text">cijena noćenja: &nbsp;<b>{{ $soba->cijena_nocenja }} BAM</b></p>
              <p class="card-text">čista: &nbsp;<b>{{ $soba->cistoca == '1' ? 'DA' : 'NE'}}</b></p><hr>
              <a href="{{ url('/admin/sobe/')}}/{{ $soba->id }}" class="btn btn-info" >Detalji <i class="fa fa-info"></i></a>&nbsp;
              <a href="{{ url('/admin/sobe/izmjena')}}/{{ $soba->id }}" class="btn btn-primary {{ $soba->status == '1' ? 'disabled' : ''}}" >Izmjena <i class="fa fa-cog"></i></a>
              <hr>
              <a href="{{ url('/admin/sobe/ociscena/')}}/{{ $soba->id }}" class="btn btn-secondary {{ $soba->cistoca == '1' ? 'disabled' : ''}}" >Očisti <i class="fa fa-leaf text-success"></i></a>&nbsp;
              <a onclick="return confirm('Da li ste sigurni?')" href="{{ url('/admin/sobe/brisi/')}}/{{ $soba->id }}" class="btn btn-warning {{ $soba->status == '1' ? 'disabled' : ''}}" >Izbriši <i class="fa fa-trash"></i></a>
              
          </div>
      </div>
    </div>
  @endif
  @endforeach
  </div>
</div>
</div> <br>                                
@endsection