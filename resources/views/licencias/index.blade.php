@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
      <div id="alert_param_lic" class="alert alert-danger alert-dismissible fade show" style="display:none">
        <button class="btn close"  onClick="hideAlert()">&times;</button>
      </div>
    <h1>Licencias</h1>
    <!-- Button trigger modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" onClick="openLicModalLic(-1,'')" id="licModalbtn">
  Crear Licencia
</button>
  
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
            @foreach ($licencias as $li)
                <tr>
                    <th class="fa fa-calendar-times"></th>
                    <td>{{$li->nombre}}</td>
                    <td>{{$li->codigo}}</td>
                    <td>
                      <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="activeLic{{$li->id}}" @if ($li->baja==0) checked @endif onclick="deleteLic({{$li->id}})">
                      <label class="custom-control-label" for="activeLic{{$li->id}}"></label>
                      </div>
                    </td>
                    <td><button class="btn btn-warning fa fa-edit" onClick="openLicModalLic({{$li->id}},'{{$li->nombre}}')"></button></td>
                  {{--  <td><button class="btn btn-danger fa fa-trash" onClick="deleteLic({{$li->id}})"></button></td>--}}
                  </tr>
            @endforeach
        </tbody>
      </table>
      {{-- Pagination --}}
      <div class="d-flex justify-content-center">
        {{ $licencias->links() }}
    </div>
    <div id="modalView">
    </div> 
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      function openLicModalLic(data_id,data_name)
          {
              var op ="";
            $.ajax ({
              headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
              },
             url:'{{ route("licencias.licCreate") }}',
             method: 'post',
             data:{
              'id_lic':data_id,
              'nombre_lic':data_name
             }
            ,
            success: function(data2){
                console.log(data2);
                $('#modalView').html(data2);
                $('#licModal').modal('show'); 
             },
              error: function(){
                console.log("Error Occurred");
              }
          });
          };
          function closeLicModal() {
          $('body').removeClass('modal-open');
          $('body').css('padding-right', '');
          $(".modal-backdrop").remove();
          $('#licModal').hide();
          };
      
          function saveLic(id) {
            var op ="";
            var name=$('#nameLicModalFrm').val();
            var code=$('#codeLicModalFrm').val();
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
             url:'{{ route("licencias.licSave") }}',
             data:{
              'data':dataO, 
             }
            ,
            success: function(data2){
              $('body').removeClass('modal-open');
              $('body').css('padding-right', '');
              $(".modal-backdrop").remove();
              $('#licModal').hide();
              Swal.fire({
                                    title: "Éxito",
                                    text: "La licencia se guardo correctamente",
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
              error: function(data){
                if( data.status === 422 ) {
                  var errors = $.parseJSON(data.responseText);
                  $.each(errors.errors, function (key, value) {
                                      $('#alertLicDanger').show();
                                      $('#alertLicDanger').append('<li>'+value+'</li>');
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
      
          function deleteLic(id) {
            //if (confirm("¿Desea confirmar la eliminacion de la licencia?")) {
            var active=$('#activeLic'+id).is(":checked");
             $.ajax ({
              headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
              },
              type: 'post',
             url:'{{ route("licencias.licDelete") }}',
             data:{
              'id_lic':id, 
              'active':active,
             }
            ,
            success: function(data2){
              Swal.fire({
                                    title: "Éxito",
                                    text: "La licencia se borro correctamente",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    showLoaderOnConfirm: true,
                                    preConfirm: () => {
                                        document.location.replace(data2);
                                    }

                                });},
             error: function(data){
          if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                      Swal.fire("Oops...", "Ha ocurrido un error en la transaccion", "error");
                        $('.alert-danger').hide();
                    }
          }
          });
                 
        //  }
        }
        function hideAlert() {
      var listElements = document.querySelectorAll("#alert_param_lic li");

      for (var i = 0; (li = listElements[i]); i++) {
        li.parentNode.removeChild(li);
      }
      $('.alert-danger').hide();
    };
          </script>
      
@endsection
