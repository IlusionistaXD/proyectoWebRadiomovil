@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Usuario</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" id="formulario" action="{{ route('users.update', $user->id) }}">
            @method('PATCH') 
            @csrf
            
            <div class="form-group">
                <label for="name">Usuario:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" />
            </div>
            <div class="form-group">
                <label for="fullname">Nombre Completo:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}" />
            </div>
            <div class="form-group">
                <label for="ci">CI:</label>
                <input type="text" class="form-control" id="ci" name="ci" value="{{ $user->ci }}" />
            </div>
            <div class="form-group">
                <label for="address">Direccion:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" />
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" />
            </div>
            <button type="button" id="boton" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkUserEdit.js') }}"></script>