@extends('layouts.usu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card" style="width: 50rem;">
                <div class="card-body">


<div class="row">
    <div class="col-sm-8">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif
        <h1 class="display-3">Tarifas</h1>    
        <table class="table table-striped">
            <thead>
                <tr>
                    <td style="font-weight: bold;">ID</td>
                    <td style="font-weight: bold;">Nombre</td>
                    <td style="font-weight: bold;">Tramo</td>
                    <td style="font-weight: bold;">Precio</td>
                    <td style="font-weight: bold;">Promocion</td>
                    <td style="font-weight: bold;">Servicio</td>
                </tr>
            </thead>
            <tbody>
                @foreach($tarifas as $tarifa)
                <tr>
                    <td>{{$tarifa->id}}</td>
                    <td>{{$tarifa->name}}</td>
                    <td>{{$tarifa->tramo}}</td>
                    <td>{{$tarifa->precio}}</td>
                    <td>{{$tarifa->id_promocion}}</td>
                    <td>{{$tarifa->id_servicio}}</td>
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