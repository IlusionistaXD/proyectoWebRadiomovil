@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Eliga el servicio que requiere:') }}</div>

                
                
                <div class="card-body">
                    <form method="POST" id="formulario" action="{{ route('nuevoviaje')}}">
                        @csrf
<!--###########  ######################################################################## -->
                        <div class="form-group row">
                            <label for="id_servicio" class="col-md-4 col-form-label text-md-right">{{ __('Servicio') }}</label>
                            <div class="col-md-6">
                                <select onchange="OnSelectionChange" class="form-control @error('id_servicio') is-invalid @enderror" name="id_servicio" id="id_servicio">
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

