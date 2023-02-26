@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
<div class="container"> 
    <h1>Roles: {{$profesor->nombre}} {{$profesor->apellido}} </h1>
    
    <div class="">
          <!-- Modal -->
<!--<div class="modal-backdrop fade in"  ></div>-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="btnRolCreate" onClick="openRolAbmModal(-1,{{$profesor->id}})">
  Crear Rol
</button>
 <!-- Modal -->
 <div id="modalView">
</div> 
      </div>
    <br>

    <br>
    <table class="table" name="order_table" id="order_table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Rol</th>
          <th scope="col">Sit Revista</th>
          <th scope="col">Observacion</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Fecha Baja</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
      </thead>
    <tbody>
  @foreach ($rxps as $r)
  <tr>
      <td>{{$r->nombre_rol}}</td>
      <td>{{$r->sit_revista}}</td>
      <td>{{$r->observacion}}</td>
      <td>{{$r->descripcion}}</td>
      <td>{{$r->fecha_fin}}</td>
      {{--@if($r->fecha_fin != null)        --}}
      {{--<td> <button type="button" name="deleteRolBtn" id="deleteRolBtn" class="btn btn-danger" onclick="deleteRol({{$r->id}})">Baja Rol</button></td>--}}
      <td> <button type="button" class="btn btn-danger" data-target="#rolModalDelete{{$r->id}}" data-toggle="modal" data-target-id="{{ $r->id }}">
        Asig. Fecha fin
      </button></td>
   {{--   @else
      <td></td> 
      @endif--}}

      @if($r->baja == 0)    
      <td> <button type="button" class="btn btn-primary" 
        onClick="openRolModalSem({{$r->id}},'{{$r->nombre_rol}}','{{$r->sit_revista}}')">
        Dias Semanales
      </button></td>
      @else
      <td></td> 
      @endif
      <td><a class="btn btn-primary fa fa-edit" onClick="openRolAbmModal({{$r->id}},{{$profesor->id}})"></a></td>
      <td onclick="deleteRolXProf({{$r->id}})"> <button type="button" name="deleteRolbton" id="deleteRolbton" class="btn btn-danger fa fa-trash"></button></td>
     
  </tr>
{{-- /ModalSem --}}
      
<!-- ModalDelete -->
    <div class="modal fade" id="rolModalDelete{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="rolModalDeleteLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rolModalDeleteLabel">Asig. fecha fin rol: {{$r->nombre_rol}} - {{$r->sit_revista}} - {{$r->descripcion}}  </h5>
            <button id="btnCloseDeleteRol" type="button" class="close" data-bs-dismiss="modal" aria-label="Close" 
            onClick="closeRolDeleteModal({{$r->id}})">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container"> 
              <div class="alert alert-danger" style="display:none"></div>
              <form action="{{route('profesors.rolDelete')}}" method="POST">
                  @csrf
                  <div class="form-row">     
                    <div class="form-group col-lg-12 col-md-6">
                      <label for="inputDate">Fecha de baja</label>
                      <input type="date" name="fecha_fin{{$r->id}}" id="fecha_fin{{$r->id}}" class="form-control" placeholder="Fecha de baja"  />
                    </div>
                  </div>
                  <br>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" name="frmRolDelete" id="frmRolDelete" onClick="deleteRol({{$r->id}})" >Asig. Fecha Fin</button>
                    </div>
          </div>
          
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </tr>
{{-- /ModalDelete --}}
  @endforeach
   
  </tbody>
  </table>

  <div id="modalView">
  </div> 
</div>
    
<script>
function saveRolSem(id,id_rol_prof) {
      var op ="";
      var monday=!($('#mondayModalFrm').is(":checked"));
      var tuesday=!($('#tuesdayModalFrm').is(":checked"));
      var wenesday=!($('#wenesdayModalFrm').is(":checked"));
      var thursday=!($('#thursdayModalFrm').is(":checked"));
      var friday=!($('#fridayModalFrm').is(":checked"));
      var saturday=!($('#saturdayModalFrm').is(":checked"));
      var dataO = 
      {
        id:id,
        id_rol_prof: id_rol_prof, 
        monday:monday,
        tuesday : tuesday,
        wenesday : wenesday,
        thursday : thursday,
        friday : friday,
        saturday : saturday,
      };
        $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("profesors.rolSaveSemDays") }}',
       data:{
        'data':dataO, 
       }
      ,
      success: function(data2){
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $(".modal-backdrop").remove();
        $('#rolModalSem').hide();
          Swal.fire({
                                    title: "Éxito",
                                    text: "Dias semanales por rol establecidos con éxito",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    showLoaderOnConfirm: true,
                                    preConfirm: () => {
                                        document.location.replace(data2);
                                    }

                                });
       },
        error: function(){
          Swal.fire("Oops...", "Ha ocurrido un error en la transaccion", "error");
          console.log("Error Occurred");
        }
    });
           
    }

    function openRolModalSem(data_id,data_name,data_sit)
    {
        var op ="";
      $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
       url:'{{ route("profesors.rolSemDays") }}',
       method: 'post',
       data:{
        'id_rol_prof':data_id, 
        'nombre_rol':data_name, 
        'data_sit':data_sit,
        'legajo': $('#legajo').val(), 
       }
      ,
      success: function(data2){
          console.log(data2);
          $('#modalView').html(data2);
          $('#rolModalSem').modal('show'); 
         //$("#tableview").empty().html(data2);
       },
        error: function(){
          console.log("Error Occurred");
        }
    });
    };
  //SAVE FORM saveRolAbm
  function saveRolAbm(id) {
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: "{{route('profesors.rolCreate')}}",
                    method: 'post',
                    data: {
                      id:id,
                      id_rol: $('#rolfrm').val(),
                      sit_revista: $('#sitRevistafrm').val(), 
                      legajo: $('#legajo').val(), 
                      observacion :  $('#observacionfrm').val(), 
                      descripcion :  $('#descripcionfrm').val(), 
                    },
                    success: function(result){
                        if(!result.errors)
                        {
                          $('.alert-danger').hide();
                            $('#licModal').modal('hide');

                            window.location.replace(result);
                            
                        }
                    },
                    error :function( data ) {
        if( data.status === 422 ) {
            var errors = $.parseJSON(data.responseText);
            $.each(errors.errors, function (key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $('#licModal').modal('hide');
                        }
                    }
                });
              }


   $('#deleteRolBtn').on('click',function(){
      $('#rolModalDelete').modal('show');
    });

   /* $(document).ready(function(){
            $('#frmRolDelete').click(function(e){
      var value = $(this).attr('data-id');
      deleteRol(value);
            });
        });*/
    
  function deleteRol(data) {
  if(confirm("¿Desea confirmar la asignacion de la fecha de fin del rol?")){
    var op ="";
    //var fec_fin =document.getElementById("fecha_fin"+data).value;
    var fec_fin = $('#fecha_fin'+data).val();
      $.ajax ({
      headers: {
      'X-CSRF-Token': '{{ csrf_token() }}',
      },
      type: 'post',
     url:'{{ route("profesors.rolDelete") }}',
     data:{
      'id_rol_x_pro':data, 
      'legajo':{{$profesor->legajo}} ,
      'fecha_fin':fec_fin, 
     }
    ,
    success: function(data2){
       //$('#tableview').html(data2);

        
        $('.alert-danger').hide();
        $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal-backdrop").remove();
    $('#rolModalDelete'+data).hide();
    Swal.fire({
                                    title: "Éxito",
                                    text: "La fecha a sido asignada correctamente",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    showLoaderOnConfirm: true,
                                    preConfirm: () => {
                                        document.location.replace(data2);
                                    }

                                });
     },
      error: function(dataerr){
        if( dataerr.status === 422 ) {
            var errors = $.parseJSON(dataerr.responseText);
            $.each(errors.errors, function (key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $('#licModal').modal('hide');
                        }
      }
  });
          //alert('test ok');
      }
  }

    function closeRolDeleteModal(data) {
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal-backdrop").remove();
    $('#rolModalDelete'+data).hide();
    };
  
    $("#btnRolCloseCreate").click(function () {
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal-backdrop").remove();
    $('#rolModalCreate').hide();
    });

    function deleteRolXProf(data) {
    if(confirm("¿Desea confirmar la eliminacion del Rol?")){
      var op ="";
        $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("profesors.rolXProfDelete") }}',
       data:{
        'id_rol':data, 
        'legajo':{{$profesor->legajo}},
       },
    success: function(data2){
         //$('#tableview').html(data2);
          alert('Rol eliminado con éxito.');
          Swal.fire({
                                    title: "Éxito",
                                    text: "El rol se elimino con éxito",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    showLoaderOnConfirm: true,
                                    preConfirm: () => {
                                        document.location.replace(data2);
                                    }

                                });
          //window.location.replace(data2);
       },
        error: function(){
          Swal.fire("Oops...", "Ha ocurrido un error en la transaccion", "error");
          console.log("Error Occurred");
        }
    });
            //alert('test ok');
        }
    }

    function openRolAbmModal(data_id,id_persona)
          {
              var op ="";
            $.ajax ({
              headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
              },
             url:'{{ route("profesors.rolAbmCreate") }}',
             method: 'post',
             data:{
              'id':data_id,
              'id_persona':id_persona
             }
            ,
            success: function(data2){
                $('#modalView').html(data2);
                $('#rolModalCreate').modal('show'); 
             },
              error: function(){
                console.log("Error Occurred");
              }
          });
          };
  </script>

@endsection