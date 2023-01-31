@extends('layouts.app')
@section('title', 'HOME PHP')

@section('content')
    <div class="container">

        <h1>Personas</h1>
        <!-- Button trigger modal -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            
<div class="col-lg-4 col-md-4 float-right">
            <div class="input-group">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" id="searchProfInp" />
                <button type="button" class="btn btn-outline-primary" onClick="searchProfesor()">search</button>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <button type="button" class="btn btn-primary" id="btnProf" onClick="openProfModal(-1,'')">
              Crear Profesor
          </button>
      </div>
      </div>
        <br>
        <!-- Modal -->
        <div id="modalView">
        </div> 
    </div>
    
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col"></th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Legajo</th>
            <th scope="col">Es Profesor</th>
            <th scope="col">Ausentes</th>
            <th scope="col">Roles</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($profesores as $profesor)
                <tr>
                    <th class="fa fa-user"></th>
                    <td>{{$profesor->nombre}}</td>
                    <td>{{$profesor->apellido}}</td>
                    <td>{{$profesor->legajo}}</td>
                    <td>
                      <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" disabled id="customSwitch2" @if ($profesor->es_profesor) checked @endif>
                      <label class="custom-control-label" for="customSwitch2"></label>
                      </div>
                    </td>
                    <td><a class="fa fa-calendar-times" href="{{route('profesors.absents',['id_profesor' => $profesor->id])}}"></a></td>
                    <td><a class="fa fa-graduation-cap" href="{{route('profesors.roles',['id_profesor' => $profesor->id])}}"></a></td>
                    <td onclick="deleteProf({{$profesor->id}})"><a class="fa fa-times-circle" style="color:red"></a></td>
                  </tr>
            @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {{ $profesores->links() }}

    <div id="tableview">
    </div>
    </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
          var filter = $('#searchProfInp').val();
           
            $.ajax({
                url: "{{ route('profesors.filterProfesors') }}",
                data: {
                    'page': page,
                    'filter': filter,
                },
                success: function(data) {
                    $('#tableview').html(data);
                }
            });

        }

        searchProfesor();

        function searchProfesor() {
            var op = "";
            var filter = $('#searchProfInp').val();

            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: 'post',
                url: '{{ route('profesors.filterProfesors') }}',
                data: {
                    'filter': filter,
                },
                success: function(data2) {
                    $('#tableview').html(data2);
                    /*$('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $(".modal-backdrop").remove();
                    $('#profModal').hide();
                      alert('Operacion exitosa.');
                      window.location.replace(data2);*/
                },
                error: function(data) {
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        //alert('Ha ocurrido un error en la transaccion.');
                        Swal.fire("Ha ocurrido un erro");
                        $('.alert-danger').hide();
                        $('#profModal').modal('hide');
                    }
                    console.log("Error Occurred");
                }
            });

        }

        $("#btnCloseCreate").click(function() {
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $(".modal-backdrop").remove();
            $('#profModal').hide();
        });

        function saveProf(id) {
            var op = "";
            var isProfesor = $('#idProfesorFrm').is(":checked");
            var name = $('#nombreFrm').val();
            var lastname = $('#apellidofrm').val();
            var legajo = $('#legajofrm').val();
            var dataO = {
                id: id,
                baja: 0,
                nombre: name,
                apellido: lastname,
                legajo: legajo,
                es_profesor: isProfesor,
            };
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: 'post',
                url: '{{ route('profesors.save') }}',
                data: {
                    'data': dataO,
                },
                success: function(data2) {
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $(".modal-backdrop").remove();
                    $('#profModal').hide();
                    alert('Operacion exitosa.');
                    window.location.replace(data2);
                },
                error: function(data) {
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        alert('Ha ocurrido un error en la transaccion.');
                        $('.alert-danger').hide();
                        $('#profModal').modal('hide');
                    }
                    console.log("Error Occurred");
                }
            });

        }

        function deleteProf(data) {
                var active=$('#activeProf'+data).is(":checked");
                var op = "";
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    type: 'post',
                    url: '{{ route('profesors.delete') }}',
                    data: {
                        'id_profesor': data,
                        'active':active,
                    },
                    success: function(data2) {

                        alert('Profesor/a modificado con éxito.');
                        window.location.replace(data2);
                    },
                    error: function() {
                        alert('Ha ocurrido un error en la transaccion.');
                        console.log("Error Occurred");
                    }
                });
                //alert('test ok');
            
        }

        function openProfModal(data_id)
          {
              var op ="";
            $.ajax ({
              headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
              },
             url:'{{ route("profesors.profCreate") }}',
             method: 'post',
             data:{
              'id':data_id,
             }
            ,
            success: function(data2){
                $('#modalView').html(data2);
                $('#profModal').modal('show'); 
             },
              error: function(){
                console.log("Error Occurred");
              }
          });
          };
          function closeProfModal() {
          $('body').removeClass('modal-open');
          $('body').css('padding-right', '');
          $(".modal-backdrop").remove();
          $('#profModal').hide();
          };
    </script>
@endsection
