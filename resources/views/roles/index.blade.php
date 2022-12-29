@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
      
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
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <th class="fa fa-user"></th>
                    <td>{{$rol->nombre}}</td>
                    <td>{{$rol->codigo}}</td>
                    {{--<td>{{$rol->baja}}</td>
                    <td><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" @if($rol->baja == 1) checked @endif></td>--}}
                    <td><button class="btn btn-warning fa fa-edit" onClick="openRolModalRol({{$rol->id}},'{{$rol->nombre}}')"></button></td>
                    <td><button class="btn btn-danger fa fa-trash" onClick="deleteRol({{$rol->id}})"></button></td>
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
          console.log(data2);
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
                            $('#licModal').modal('hide');
                        }
          console.log("Error Occurred");
        }
    });
           
    }

    function deleteRol(id) {
       $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("roles.rolDelete") }}',
       data:{
        'id_rol':id, 
       }
      ,
      success: function(data2){
          alert('Operacion exitosa.');
          window.location.replace(data2);
       },
        error: function(data){
          alert('Ha ocurrido un error en la transaccion.');                        
          console.log("Error Occurred: "+data);
        }
    });
           
    }
    </script>
@endsection
