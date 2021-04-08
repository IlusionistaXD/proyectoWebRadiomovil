@extends('layouts.app')
<?php

$psqli = pg_connect("host=mail.tecnoweb.org.bo port=5432 dbname=db_grupo21sa user=grupo21sa password=grup021grup021");

?>
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Permiso</h1>
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
        <form method="POST" id="formulario" action="{{ route('permisos.update', $permiso->id) }}">
            @method('PATCH') 
            @csrf
                        <div class="form-group">
                            <label for="id_user" >{{ __('Chofer') }}</label>
                            <select class="form-control" name="id_user" id="id_user">
                                    @foreach($users as $user)
                                         @if($user->id == $permiso->id_user)
                                            <option value={{$user->id}} selected >{{$user->name}}</option>;
                                        @else
                                            <option value={{$user->id}} >{{$user->name}}</option>;
                                        @endif
                                    @endforeach
                            
                            </select>
                        </div>

            <div class="form-group">
                <label for="motivo">Motivo:</label>
                <input type="text" class="form-control" id="motivo" name="motivo" value="{{ $permiso->motivo }}" />
            </div>
            <div class="form-group">
                <label for="fec_ini">Fecha inicio:</label>
                <input type="date" class="form-control" id="fec_ini" name="fec_ini" value="{{ $permiso->fec_ini }}" />
            </div>
            <div class="form-group">
                <label for="fec_fin">Fecha fin:</label>
                <input type="date" class="form-control" id="fec_fin" name="fec_fin" value="{{ $permiso->fec_fin }}" />
            </div>
             <button type="button" id="boton" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkPermiso.js') }}"></script>