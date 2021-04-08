@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Permisos') }}</div>

                <div class="card-body">
                    <form method="POST"  id="formulario" action="{{ route('permisos.store') }}">
                        @csrf
<!--################################################################################### -->
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
                            <label for="motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>

                            <div class="col-md-6">
                                <input id="motivo" type="text" class="form-control @error('motivo') is-invalid @enderror" id="motivo" name="motivo" value="{{ old('motivo') }}" required autocomplete="motivo" autofocus>

                                @error('motivo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fec_ini" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>

                            <div class="col-md-6">
                                <input id="fec_ini" type="date" class="form-control @error('fec_ini') is-invalid @enderror" id="fec_ini" name="fec_ini" value="{{ old('fec_ini') }}" required autocomplete="fec_ini" autofocus>

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
                                <input id="fec_fin" type="date" class="form-control @error('fec_fin') is-invalid @enderror" id="fec_fin" name="fec_fin" value="{{ old('fec_fin') }}" required autocomplete="fec_fin">

                                @error('fec_fin')
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
<script src="{{ asset('js/checkPermiso.js') }}"></script>