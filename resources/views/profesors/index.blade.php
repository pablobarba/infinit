@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
      
    <h1>Profesores</h1>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profModal" id="btnProf">
  Crear Profesor
</button>
<br>
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
                  <div class="form-group col-lg-12 col-md-12">   
                      <input type="checkbox" class="" id="idProfesorFrm">
                      <label class="form-check-label" for="check1">Es profesor</label>   
              </div>
          </div>
              </div>
              <br>
            </form>
            <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="formSubmit" onClick="saveProf()" >Grabar</button>
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

function saveProf(id) {
      var op ="";
      var isProfesor=$('#idProfesorFrm').is(":checked");
      var name=$('#nombreFrm').val();
      var lastname=$('#apellidofrm').val();
      var legajo=$('#legajofrm').val();
      var dataO = 
      {
        id:id,
        baja: 0, 
        nombre:name,
        apellido : lastname,
        legajo : legajo,
        es_profesor : isProfesor,
      };
        $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("profesors.save") }}',
       data:{
        'data':dataO, 
       }
      ,
      success: function(data2){
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $(".modal-backdrop").remove();
        $('#profModal').hide();
          alert('Operacion exitosa.');
          window.location.replace(data2);
       },
        error: function(data){
          if( data.status === 422 ) {
            var errors = $.parseJSON(data.responseText);
            $.each(errors.errors, function (key, value) {
                                $('#alertRolDanger').show();
                                $('#alertRolDanger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            alert('Ha ocurrido un error en la transaccion.');
                            $('.alert-danger').hide();
                            $('#profModal').modal('hide');
                        }
          console.log("Error Occurred");
        }
    });
           
    }

    </script>
@endsection
