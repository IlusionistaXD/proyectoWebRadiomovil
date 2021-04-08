@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">

<div>
    <a style="margin: 19px;" href="{{ route('permisos.create')}}" class="btn btn-primary">Nuevo Permiso</a>
</div>

<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Permisos</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Usuario</td>
          <td>motivo</td>
          <td>Fecha inicio</td>
          <td>Fecha fin</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($permisos as $permiso)
        <tr>
            <td>{{$permiso->id}}</td>
            <td>{{$permiso->id_user}}</td>
            <td>{{$permiso->motivo}}</td>
            <td>{{$permiso->fec_ini}}</td>
            <td>{{$permiso->fec_fin}}</td>
            <td>
                <a href="{{ route('permisos.edit',$permiso->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('permisos.destroy', $permiso->id)}}" method="POST">
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