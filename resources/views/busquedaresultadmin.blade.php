@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">Aqui se debera mostrar los resultados, dependiendo el tipo de busqueda tal vez sea en otra vista. Las opciones que estan para elegir la tabla en que quieres buscar se puede quitar despues</div>
                
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection