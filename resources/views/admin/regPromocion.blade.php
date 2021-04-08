@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Promociones') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('regpromocion') }}">
                        @csrf
<!--################################################################################### -->
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
