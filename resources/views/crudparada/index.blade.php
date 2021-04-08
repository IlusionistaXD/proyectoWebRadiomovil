@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">

<div>
    <a style="margin: 19px;" href="{{ route('paradas.create')}}" class="btn btn-primary">Nueva Parada</a>
</div>

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
          <td>ID</td>
          <td>Nombre</td>
          <td>Direccion</td>
          <td>Descripcion</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($paradas as $parada)
        <tr>
            <td>{{$parada->id}}</td>
            <td>{{$parada->name}}</td>
            <td>{{$parada->address}}</td>
            <td>{{$parada->description}}</td>

            <td>
                <a href="{{ route('paradas.edit',$parada->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('paradas.destroy', $parada->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </td>
            
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