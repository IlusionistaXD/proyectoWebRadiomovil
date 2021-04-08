@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Viajes') }}</div>

                
                
                <div class="card-body">
                    <form method="POST" id="formulario" action="{{ route('viajes.store') }}">
                        @csrf
<!--###########  ######################################################################## -->
                        
                        <div class="form-group row">
                            <label for="id_tarifa" class="col-md-4 col-form-label text-md-right">{{ __('Tarifa') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_tarifa') is-invalid @enderror" name="id_tarifa" id="id_tarifa">
                                    @foreach($tarifas as $tarifa)
                                        <option value={{$tarifa->id}} selected >{{$tarifa->name}}</option>';
                                    @endforeach
                                </select>
                                @error('id_tarifa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_movil" class="col-md-4 col-form-label text-md-right">{{ __('Movil') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_movil') is-invalid @enderror" name="id_movil" id="id_movil">
                                    @foreach($movils as $movil)
                                        <option value={{$movil->id}} selected> {{$movil->modelo}} {{$movil->placa}} </option>;
                                    @endforeach
                                </select>
                                @error('id_movil')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="boton" class="btn btn-primary">
                                    {{ __('Reservar Viaje') }}
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


