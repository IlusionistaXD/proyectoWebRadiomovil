@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Automovil') }}</div>

                <div class="card-body">
                    <form method="POST" id="formulario" action="{{ route('movils.store') }}">
                        @csrf
<!--################################################################################### -->
                        <div class="form-group row">
                            <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>

                            <div class="col-md-6">
                                <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ old('placa') }}" required autocomplete="placa" autofocus>

                                @error('placa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                            <div class="col-md-6">
                                <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ old('modelo') }}" required autocomplete="modelo" autofocus>

                                @error('modelo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="anio" class="col-md-4 col-form-label text-md-right">{{ __('Año') }}</label>

                            <div class="col-md-6">
                                <input id="anio" type="text" class="form-control @error('anio') is-invalid @enderror" name="anio" value="{{ old('anio') }}" required autocomplete="anio">

                                @error('anio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_user" class="col-md-4 col-form-label text-md-right">{{ __('Chofer') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control @error('id_user') is-invalid @enderror" name="id_user" id="id_user">
                                @foreach($users as $user)
                                        <option value={{$user->id}} selected >{{$user->name}}</option>';
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>


                        <div class="form-group row">
                            <label for="id_parada" class="col-md-4 col-form-label text-md-right">{{ __('Parada') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_parada') is-invalid @enderror" name="id_parada" id="id_parada">
                                <option value="0" selected >Ninguno</option> <!-- No tiene ninguna promocion -->
                                <@foreach($paradas as $parada)
                                    <option value={{$parada->id}} selected >{{$parada->name}}</option>';
                                @endforeach
                                </select>
                                @error('id_parada')
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
<script src="{{ asset('js/checkMovil.js') }}"></script>
