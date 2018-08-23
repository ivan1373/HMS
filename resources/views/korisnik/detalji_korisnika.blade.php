@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>DETALJI KORISNIKA</h1>
</div>
@endsection
@section('content')
<div class="container">
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active bg-info" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><b>Osnovne Informacije</b></a>
  </li>&nbsp;
  <li class="nav-item">
    <a class="nav-link bg-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><b>Napomene</b></a>
  </li>&nbsp;
  <li class="nav-item">
    <a class="nav-link bg-primary" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><b>Postavke</b></a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <br><div class="container">
        <!-- general form elements -->
        <div class="card">
        <div class="card-header bg-info">
                <h3 class="card-title"><i class="fa fa-info"></i> Osnovne Informacije</h3>
              </div>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{url('images/user1.png')}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">
                  @if( $user->isregular == '1' && $user->isadmin == '1' )
                  SUPERADMINISTRATOR
                  @elseif( $user->isregular && $user->isadmin != '1')
                  STANDARDNI
                  @else
                  ADMINISTRATOR
                  @endif
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>E-Mail</b> <a class="float-right">{{$user->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Broj Napomena</b> <a class="float-right">{{$brNapomena}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Broj Stvorenih Rezervacija</b> <a class="float-right">{{$brRez}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              @if(session()->has('spremanje'))
              
              <div style="background-color:#D4EDDA!important;color:green!important;" class="alert alert-success">
                  <strong>{{session()->get('spremanje')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
              </div>
                  
            @endif
            </div>
                <!-- /.card-body -->
        </div>
        </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <br><div class="container">
        <!-- general form elements -->
        <div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title"><i class="fa fa-file"></i> Napomene</h3>
              </div>
              
                <div class="card-body">
                <div class="list-group">
                  @forelse($napomene as $napomena)
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><b>{{ $napomena->naslov }}</b></h5>
                    <small>{{ $napomena->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $napomena->sadrzaj }}</p>
                    <small>-{{ $napomena->user->name }}</small>
                    @empty
                    <p>Trenutno nema napomena od tog korisnika</p>
                    @endforelse
                  </a>
                </div>
                </div>
                
        </div>
                <!-- /.card-body -->
        </div>
        </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <br><div class="container">
        <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title"><i class="fa fa-cog"></i> Promijenite podatke</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
                
              </div>
              @endif
              <form method="post" role="form" action="{{url('/admin/pregled_korisnika/uredi_podatke')}}/{{$user->id}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Ime</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" name="ime">
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                  </div>
                  <div class="form-group">
                    <label>Lozinka</label>
                    <input type="text" class="form-control" placeholder="unesite novu lozinku..." name="password">
                  </div>
                <div class="form-group">
                  <label>Vrsta Korisničkog Računa</label>
                  <select name="role" class="form-control" style="width: 100%;">
                    <option selected="selected" value="Standardni">Standardni</option>
                    <option value="Administrator">Administrator</option>
                    <option value="SuperAdministrator">SuperAdministrator</option>
                  </select>
                </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-success">Potvrdi <i class="fa fa-check"></i></button>
                <button type="reset" class="btn btn-warning">Poništi <i class="fa fa-power-off"></i></button>
                </div>
              </form>
            
            
        </div>
                <!-- /.card-body -->
    </div>
    </div>
</div>
</div>
@endsection