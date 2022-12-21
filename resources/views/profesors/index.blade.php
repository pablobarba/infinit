@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
      
    <h1>Profesores</h1>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profModal" id="btnProf">
  Crear Profesor
</button>
    <!-- Modal -->
<div class="modal fade" id="profModal" tabindex="-1" role="dialog" aria-labelledby="profModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="licModalLabel">Crear Profesor</h5>
        <button  id="btnCloseCreate" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container"> 
          <div class="alert alert-danger" style="display:none"></div>
          <form action="{{route('profesors.licCreate')}}" method="POST">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputNombre">Nombre</label>
                  <input type="text" name='nombreFrm' id="nombreFrm" class="form-control" id="inputNombre" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputApellido">Apellido</label>
                  <input type="text" name="apellidofrm" id="apellidofrm" class="form-control" placeholder="Apellido"  />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputLegajo">Legajo</label>
                  <input type="number" name="legajofrm" id="legajofrm" class="form-control" placeholder="Legajo"  />
                </div>
              </div>
              <br>
            </form>
            <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="formSubmit">Grabar</button>
                </div>
      </div>
      
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
{{-- /Modal --}}
    <!--<ul class="list-group">
        @foreach ($profesores as $profesor)
            <li class="list-group-item">{{$profesor->nombre}}</li>
        @endforeach
    </ul>

    {{$profesores->links()}}-->


    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col"></th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Legajo</th>
            <th scope="col">Presentes</th>
            <th scope="col">Ausentes</th>
            <th scope="col">Roles</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($profesores as $profesor)
                <tr>
                    <th class="fa fa-user"></th>
                    <td>{{$profesor->nombre}}</td>
                    <td>{{$profesor->apellido}}</td>
                    <td>{{$profesor->legajo}}</td>
                    <td><a class="fa fa-calendar"  ></a></td>
                    <td><a class="fa fa-calendar-times" href="{{route('profesors.absents',['id_profesor' => $profesor->id])}}"></a></td>
                    <td><a class="fa fa-graduation-cap" href="{{route('profesors.roles',['id_profesor' => $profesor->id])}}"></a></td>
                  </tr>
            @endforeach
        </tbody>
      </table>
      {{-- Pagination --}}
      <div class="d-flex justify-content-center">
        {{ $profesores->links() }}
    </div>
    </div>

    <script>
$('#btnProf').on('click',function(){
      $('#profModal').modal('show');
    })

    $("#btnCloseCreate").click(function () {
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal-backdrop").remove();
    $('#profModal').hide();
});


    </script>
@endsection
