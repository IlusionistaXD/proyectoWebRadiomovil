@extends('layouts.menu')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estadisticas') }}</div>

                
                
                <div class="card-body">
                    <form method="POST" id="formulario" action="{{ route('estadistica.store')}}">
                        @csrf
<!--###########  ######################################################################## -->
                        <div class="form-group row">
                            <label for="fec_ini" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>

                            <div class="col-md-6">
                                <input id="fec_ini" type="date" class="form-control @error('fec_ini') is-invalid @enderror" name="fec_ini" value="{{ old('fec_ini') }}" required autocomplete="fec_ini" autofocus>

                                @error('fec_ini')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fec_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha fin') }}</label>

                            <div class="col-md-6">
                                <input id="fec_fin" type="date" class="form-control @error('fec_fin') is-invalid @enderror" name="fec_fin" value="{{ old('fec_fin') }}" required autocomplete="fec_fin">

                                @error('fec_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="id_servicio" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione:') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_servicio') is-invalid @enderror" name="id_servicio" id="id_servicio">
                                        <option value="0" selected >Usuarios nuevos al dia</option>;
                                        <option value="1" selected >Viajes al dia</option>;
                                        <option value="2" selected >Monto Ganado al dia</option>;
                                        <option value="3" selected >Monto Ganado por Servicio</option>;
                                </select>
                                @error('id_servicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                   

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="boton" class="btn btn-primary">
                                    {{ __('Continuar') }}
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
<script src="{{ asset('js/checkConfirmDates.js') }}"></script>