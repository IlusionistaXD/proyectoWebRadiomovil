@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tarifas') }}</div>

                <div class="card-body">
                    <form method="POST"  id="formulario" action="{{ route('tarifas.store') }}">
                        @csrf
<!--################################################################################### -->
                        <div class="form-group row">
                            <label for="id_servicio" class="col-md-4 col-form-label text-md-right">{{ __('Servicio') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_servicio') is-invalid @enderror" name="id_servicio" id="id_servicio">
                                @foreach($servicios as $servicio)
                                    <option value={{$servicio->id}} selected >{{$servicio->name}}</option>';
                                @endforeach
                                </select>
                                @error('id_servicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_promocion" class="col-md-4 col-form-label text-md-right">{{ __('Promocion') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_promocion') is-invalid @enderror" name="id_promocion" id="id_promocion">
                                <option value="0" selected >Ninguno</option> <!-- No tiene ninguna promocion -->
                                @foreach($promocions as $promocion)
                                    <option value={{$promocion->id}} selected >{{$promocion->name}}</option>';
                                @endforeach
                                    <option value={{0}} selected >Ninguno</option>';
                                </select>
                                @error('id_promocion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tramo" class="col-md-4 col-form-label text-md-right">{{ __('Tramo') }}</label>

                            <div class="col-md-6">
                                <input id="tramo" type="text" class="form-control @error('tramo') is-invalid @enderror" name="tramo" value="{{ old('tramo') }}" required autocomplete="tramo" autofocus>

                                @error('tramo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>

                            <div class="col-md-6">
                                <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>

                                @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="boton" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkTarifa.js') }}"></script>