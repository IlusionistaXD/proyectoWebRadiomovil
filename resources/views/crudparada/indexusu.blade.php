@extends('layouts.usu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card" style="width: 60rem;">
                <div class="card-body">


<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Paradas</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td style="font-weight: bold;">ID</td>
          <td style="font-weight: bold;">Nombre</td>
          <td style="font-weight: bold;">Direccion</td>
          <td style="font-weight: bold;">Descripcion</td>
        </tr>
    </thead>
    <tbody>
        @foreach($paradas as $parada)
        <tr>
            <td>{{$parada->id}}</td>
            <td>{{$parada->name}}</td>
            <td>{{$parada->address}}</td>
            <td>{{$parada->description}}</td>
            
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