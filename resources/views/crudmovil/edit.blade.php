@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">


<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Movil</h1>
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
        <form method="post" id="formulario" action="{{ route('movils.update', $movil->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" class="form-control" name="placa" id="placa" value="{{ $movil->placa }}" />
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" name="modelo" id="modelo" value="{{ $movil->modelo }}" />
            </div>
            <div class="form-group">
                <label for="anio">Año:</label>
                <input type="text" class="form-control" name="anio" id="anio" value="{{ $movil->anio }}" />
            </div>
            <div class="form-group">
                <label for="description">Descripcion:</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ $movil->description }}" />
            </div>

                
                @csrf
                <div class="form-group">
                    <label for="id_user" >{{ __('Chofer') }}</label>
                    <select class="form-control" name="id_user" id="id_user">
                            @foreach($users as $user)
                                @if($user->id == $movil->id_user)
                                    <option value={{$user->id}} selected >{{$user->name}}</option>;
                                @else
                                    <option value={{$user->id}} >{{$user->name}}</option>;
                                @endif
                             @endforeach

                    </select>
                </div>

                @csrf
                <div class="form-group">
                    <label for="id_parada" >{{ __('Parada') }}</label>
                    <select class="form-control" name="id_parada" id="id_parada">
                            @foreach($paradas as $parada)
                                @if($parada->id == $movil->id_parada)
                                    <option value={{$parada->id}} selected >{{$parada->name}}</option>;
                                @else
                                    <option value={{$parada->id}} >{{$parada->name}}</option>;
                                @endif
                            @endforeach
                            @if($movil->id_parada == '0')
                                <option value={{0}} selected>Ninguno</option>;
                            @else
                                <option value={{0}} >Ninguno</option>;
                            @endif
                    </select>
                </div>


            <button type="button" id="boton" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkMovil.js') }}"></script>