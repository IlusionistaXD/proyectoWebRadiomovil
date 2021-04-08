@extends('layouts.menu')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Generar reporte') }}</div>

                
                
                <div class="card-body">
                    <form method="POST" id="formulario" action="{{ route('nuevoreporte.store')}}">
                        @csrf
<!--###########  ######################################################################## -->
                        <div class="form-group row">
                            <label for="id_servicio" class="col-md-4 col-form-label text-md-right">{{ __('Informacion') }}</label>
                            <div class="col-md-6">
                                <select onchange="OnSelectionChange" class="form-control @error('id_servicio') is-invalid @enderror" name="id_servicio" id="id_servicio">
                                        <option value="0" selected >Permisos</option>;
                                        <option value="1" selected >Usuarios</option>;
                                        <option value="2" selected >Paradas</option>;
                                        <option value="3" selected >Moviles</option>;
                                        <option value="4" selected >Servicios</option>;
                                        <option value="5" selected >Tarifas</option>;
                                        <option value="6" selected >Promociones</option>;
                                        <option value="7" selected >Viaje</option>;

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
                                <button type="submit" id="boton" class="btn btn-primary">
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

