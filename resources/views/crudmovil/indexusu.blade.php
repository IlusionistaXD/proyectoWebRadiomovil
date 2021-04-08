@extends('layouts.usu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card" style="width: 65rem;">
                <div class="card-body">


  <div class="row">
  <div class="col-xs-12 col-md-12">
      @if(session()->get('success'))
          <div class="alert alert-success">
          {{ session()->get('success') }}  
          </div>
      @endif
      <h1 class="display-3">Moviles</h1>    
    <table class="table table-striped">
      <thead>
          <tr>
            <td style="font-weight: bold;">ID</td>
            <td style="font-weight: bold;">Placa</td>
            <td style="font-weight: bold;">Modelo</td>
            <td style="font-weight: bold;">Año</td>
            <td style="font-weight: bold;">Usuario</td>
            <td style="font-weight: bold;">Parada</td>
 
          </tr>
      </thead>
      <tbody>
          @foreach($movils as $movil)
          <tr>
              <td>{{$movil->id}}</td>
              <td>{{$movil->placa}}</td>
              <td>{{$movil->modelo}}</td>
              <td>{{$movil->anio}}</td>
              <td>{{$movil->id_user}}</td>
              <td>{{$movil->id_parada}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
  </div>

  </div>
            </div>
        </div>
    </div>
</div>


@endsection