@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Promocion</h1>
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
        <form method="POST" id="formulario" action="{{ route('promocions.update', $promocion->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $promocion->name }}" />
            </div>
            <div class="form-group">
                <label for="description">descripcion:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $promocion->description }}" />
            </div>
            <div class="form-group">
                <label for="fec_ini">Fecha inicio:</label>
                <input type="date" class="form-control" id="fec_ini" name="fec_ini" value="{{ $promocion->fec_ini }}" />
            </div>
            <div class="form-group">
                <label for="fec_fin">Fecha fin:</label>
                <input type="date" class="form-control" id="fec_fin" name="fec_fin" value="{{ $promocion->fec_fin }}"/>
            </div>

            <button type="button" id="boton" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkPromocion.js') }}"></script>