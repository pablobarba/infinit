@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
      
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
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($licencias as $li)
                <tr>
                    <th class="fa fa-user"></th>
                    <td>{{$li->nombre}}</td>
                    <td>{{$li->codigo}}</td>
                    <td><button class="btn btn-warning fa fa-edit" onClick="openLicModalLic({{$li->id}},'{{$li->nombre}}')"></button></td>
                    <td><button class="btn btn-danger fa fa-trash" onClick="deleteLic({{$li->id}})"></button></td>
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
                alert('Operacion exitosa.');
                window.location.replace(data2);
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
                                  alert('Ha ocurrido un error en la transaccion.');
                                  $('.alert-danger').hide();
                                  $('#licModal').modal('hide');
                              }
                console.log("Error Occurred");
              }
          });
                 
          }
      
          function deleteLic(id) {
             $.ajax ({
              headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
              },
              type: 'post',
             url:'{{ route("licencias.licDelete") }}',
             data:{
              'id_lic':id, 
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
