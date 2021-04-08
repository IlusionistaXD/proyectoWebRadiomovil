@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-push-8">
            <div class="card" >
                <div class="card-body">

<div>
    <a style="margin: 19px;" href="{{ route('register')}}" class="btn btn-primary">Nuevo usuario</a>
</div>

<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Usuarios</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Usuario</td>
          <td>Nombre Completo</td>
          <td>Email</td>
          <td>CI</td>
          <!--<td>Direccion</td>-->
          <td>Telefono</td>
          <td>Rol</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->fullname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->ci}}</td>
            <!--<td>{{$user->address}}</td>-->
            <td>{{$user->phone}}</td>
            <?php

              switch ($user->is_admin) {
                case 0:
                    $data = "Usuario";
                    break;
                case 1:
                    $data = "Chofer";
                    break;
                case 2:
                    $data = "Administrador";
                    break;
              }
            ?>
            <td>{{$data}}</td>
            <td>
                <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
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