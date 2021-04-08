@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Parada</h1>
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
        <form method="post" id="formulario" action="{{ route('paradas.update', $parada->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $parada->name }}" />
            </div>
            <div class="form-group">
                <label for="address">Direccion:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $parada->address }}" />
            </div>
            <div class="form-group">
                <label for="description">Descripcion:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $parada->description }}" />
            </div>
            <button type="button" id="boton" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkParada.js') }}"></script>