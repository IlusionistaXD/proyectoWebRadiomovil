@extends('layouts.app')
<?php

$psqli = pg_connect("host=mail.tecnoweb.org.bo port=5432 dbname=db_grupo21sa user=grupo21sa password=grup021grup021");

?>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tarifas') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('regtarifa') }}">
                        @csrf
<!--################################################################################### -->
                        <div class="form-group row">
                            <label for="id_servicio" class="col-md-4 col-form-label text-md-right">{{ __('Servicio') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('id_servicio') is-invalid @enderror" name="id_servicio" id="id_servicio">
                                <?php
                                    $query = pg_query($psqli, "SELECT id, name FROM servicios");
                                    while ($valores = pg_fetch_array($query)) {
                                        echo '<option value="'.$valores["id"].'">'.$valores["name"].'</option>';
                                    }
                                ?>
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
                                <?php
                                    $query = pg_query($psqli, "SELECT id, name FROM promocions");
                                    while ($valores = pg_fetch_array($query)) {
                                        echo '<option value="'.$valores["id"].'">'.$valores["name"].'</option>';
                                    }
                                ?>
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
                                <input id="precio" type="text" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>

                                @error('precio')
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
