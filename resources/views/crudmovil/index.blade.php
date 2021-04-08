@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card" style="width: 65rem;">
                <div class="card-body">

<div>
    <a style="margin: 19px;" href="{{ route('movils.create')}}" class="btn btn-primary">Nuevo Movil</a>
</div>


  <div class="row">
  <div class="col-xs-12 col-md-12">
      @if(session()->get('success'))
          <div class="alert alert-success">
          {{ session()->get('success') }}  
          </div>
      @endif
      <h1 class="display-3">Moviles</h1>    
    <table class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>Placa</td>
            <td>Modelo</td>
            <td>Año</td>
            <td>Usuario</td>
            <td>Parada</td>
         
            <td colspan = 2>Acciones</td>
 
          </tr>
      </thead>
      <tbody>
          @foreach($movils as $movil)
          <tr>
              <td>{{$movil->id}}</td>
              <td>{{$movil->placa}}</td>
              <td>{{$movil->modelo}}</td>
              <td>{{$movil->anio}}</td>
              <td>{{$movil->id_user}}</td>
              <td>{{$movil->id_parada}}</td>
        
              <td>
                  <a href="{{ route('movils.edit',$movil->id)}}" class="btn btn-primary">Editar</a>
              </td>
              <td>
                  <form action="{{ route('movils.destroy', $movil->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                  </form>
              </td>
        
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
  </div>

  </div>
            </div>
        </div>
    </div>
</div>


@endsection