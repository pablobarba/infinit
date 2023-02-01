@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
    <div id="alert_param_rol" class="alert alert-danger alert-dismissible fade show" style="display:none">
      <button class="btn close"  onClick="hideAlert()">&times;</button>
    </div>
    <h1>Roles</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" onClick="openRolModalRol(-1,'')" id="rolModalbtn">
      Crear Rol
    </button>
    <br>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col"></th>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo</th>
            <th scope="col">Activo</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <th class="fa fa-graduation-cap"></th>
                    <td>{{$rol->nombre}}</td>
                    <td>{{$rol->codigo}}</td>
                    <td>
                      <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="activeRol{{$rol->id}}" @if ($rol->baja==0) checked @endif onclick="deleteRol({{$rol->id}})">
                      <label class="custom-control-label" for="activeRol{{$rol->id}}"></label>
                      </div>
                    </td>
                    {{--<td>{{$rol->baja}}</td>
                    <td><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" @if($rol->baja == 1) checked @endif></td>--}}
                    <td><button class="btn btn-warning fa fa-edit" onClick="openRolModalRol({{$rol->id}},'{{$rol->nombre}}')"></button></td>
                    {{--<td><button class="btn btn-danger fa fa-trash" onClick="deleteRol({{$rol->id}})"></button></td>--}}
                    
                  </tr>
            @endforeach
        </tbody>
      </table>
      {{-- Pagination --}}
      <div class="d-flex justify-content-center">
        {{ $roles->links() }}
    </div>
    </div>
    <div id="modalView">
    </div> 
    <script>
function openRolModalRol(data_id,data_name)
    {
        var op ="";
      $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
       url:'{{ route("roles.rolCreate") }}',
       method: 'post',
       data:{
        'id_rol':data_id,
        'nombre_rol':data_name
       }
      ,
      success: function(data2){
          
          $('#modalView').html(data2);
          $('#rolModal').modal('show'); 
         
       },
        error: function(){
          console.log("Error Occurred");
        }
    });
    };
    function closeRolModal() {
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal-backdrop").remove();
    $('#rolModal').hide();
    };

    function saveRol(id) {
      var op ="";
      var name=$('#nameRolModalFrm').val();
      var code=$('#codeRolModalFrm').val();
      var dataO = 
      {
        id:id,
        baja: 0, 
        nombre:name,
        codigo : code,
      };
        $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("roles.rolSave") }}',
       data:{
        'data':dataO, 
       }
      ,
      success: function(data2){
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $(".modal-backdrop").remove();
        $('#rolModal').hide();
        Swal.fire({
                                    title: "Éxito",
                                    text: "El rol se creo con exito",
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
                            
          Swal.fire("Oops...", "Ha ocurrido un error en la transaccion", "error");
          $('.alert-danger').hide();
            $('#licModal').modal('hide');
                        }
          console.log("Error Occurred");
        }
    });
           
    }

    function deleteRol(id) {
      //if (confirm("¿Desea confirmar la eliminacion del rol?")) {
      var active=$('#activeRol'+id).is(":checked");
       $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("roles.rolDelete") }}',
       data:{
        'id_rol':id, 
        'active':active,
       }
      ,
      success: function(data2){
          alert('Operacion exitosa.');
          window.location.replace(data2);
       },
        error: function(data){
          document.getElementById("activeRol"+id).checked = !active;
          if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        alert('Ha ocurrido un error en la transaccion.');
                        $('.alert-danger').hide();
                    }
        }
    });
  //}  
    }

    function hideAlert() {
      var listElements = document.querySelectorAll("#alert_param_rol li");

      for (var i = 0; (li = listElements[i]); i++) {
        li.parentNode.removeChild(li);
      }
      $('.alert-danger').hide();
    };
    </script>
@endsection
