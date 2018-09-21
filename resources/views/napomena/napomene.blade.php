@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>PREGLED NAPOMENA</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
  <cite>Pretražite po autoru ili naslovu napomene:<br></cite> 
  <input class="form-control" id="myInput" type="text" placeholder="Pretraži..">
  <br>
  <table class="table table-responsive tablesorter table-hover" align="center">
    <thead class="bg-secondary">
      <tr>
        <th># <i class="fa fa-sort"></i></th>
        <th>Naslov <i class="fa fa-sort"></i></th>
        <th>Autor <i class="fa fa-sort"></i></th>
        <th>Stvorena <i class="fa fa-sort"></i></th>
        <th>Radnja</th>
      </tr>
    </thead>
    <tbody id="myTable">
    @forelse($napomene as $napomena)
      <tr class="{{ $napomena->procitana == '1' ? 'procitano' : ''}}">
        <td>{{ $napomena->id }}</td>
        <td><a class="btn btn-block" href="{{ url('/admin/napomene/')}}/{{ $napomena->id }}"><b>{{ $napomena->naslov }}</b></a></td>
        <td><b>{{ $napomena->user->name }}</b></td>
        <td><b>{{ $napomena->created_at->diffForHumans() }}</b></td>
        <td>
            <a href="{{ url('/admin/napomene/procitana/')}}/{{ $napomena->id }}" class="btn btn-success {{ $napomena->procitana == '1' ? 'disabled' : ''}} btn-sm">Pročitano <i class="fa fa-check"></i></a> &nbsp;
            <form method="post" action="{{ url('/admin/napomene/izbrisana/')}}/{{ $napomena->id }}">
              @csrf
              {{ method_field('delete') }}
            <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-danger btn-sm">Izbriši <i class="fa fa-trash"></i></button>
            </form>
        </td>
      </tr>
    @empty
      <td><h5>trenutno</h5></td>
      <td><h5>nema</h5></td>
      <td><h5>nikakvih</h5></td>
      <td><h5>napomena</h5></td>
      <td><h5>. . .</h5></td>
    @endforelse
    
    </tbody>
  </table>
  {{ $napomene->links() }}
</div>
@endsection