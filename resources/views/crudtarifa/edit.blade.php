@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Tarifa</h1>
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
        <form method="post" id="formulario" action="{{ route('tarifas.update', $tarifa->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $tarifa->name }}" />
            </div>
            <div class="form-group">
                <label for="tramo">Tramo:</label>
                <input type="text" class="form-control" name="tramo" id="tramo" value="{{ $tarifa->tramo}}" />
            </div>
            <div class="form-group">
                <label for="precio">Precios:</label>
                <input type="number" class="form-control" name="precio" id="precio" value="{{ $tarifa->precios }}" />
            </div>
                @csrf
                <div class="form-group">
                    <label for="id_promocion" >{{ __('Promociones') }}</label>
                    <select class="form-control" name="id_promocion" id="id_promocion">
                            @foreach($promocions as $promocion)
                                @if($promocion->id == $tarifa->id_promocion)
                                    <option value={{$promocion->id}} selected >{{$promocion->name}}</option>';
                                @else
                                    <option value={{$promocion->id}} >{{$promocion->name}}</option>';
                                @endif
                            @endforeach
                            @if($tarifa->id_promocion == '0')
                                <option value={{0}} selected>Ninguno</option>';
                            @else
                                <option value={{0}} >Ninguno</option>';
                            @endif
                    </select>
                </div>

             
                @csrf
                <div class="form-group">
                    <label for="id_servicio" >{{ __('Servicios') }}</label>
                    <select class="form-control" name="id_servicio" id="id_servicio">
                            @foreach($servicios as $servicio)
                                @if($servicio->id == $tarifa->id_servicio)
                                    <option value={{$servicio->id}} selected >{{$servicio->name}}</option>';
                                @else
                                    <option value={{$servicio->id}} >{{$servicio->name}}</option>';
                                @endif
                            @endforeach

                    </select>
                </div>
            

                

                

            <button type="button" id="boton" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkTarifa.js') }}"></script>