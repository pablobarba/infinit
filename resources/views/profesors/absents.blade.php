@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
<div class="container"> 
    <h1>Ausentes: {{$profesor->nombre}} {{$profesor->apellido}} </h1>
    <h4>Cantidad total de ausencias: {{$lxps->count()}} </h4>
    
    <div class="">
          <!-- Modal -->
<!--<div class="modal-backdrop fade in"  ></div>-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#licModal" id="btnLic">
  Crear Licencia
</button>

<!-- Modal -->
<div class="modal fade" id="licModal" tabindex="-1" role="dialog" aria-labelledby="licModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="licModalLabel">Crear Licencia: {{$profesor->nombre}} {{$profesor->apellido}} </h5>
        <button id="btnCloseCreateLic" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container"> 
          <div class="alert alert-danger" style="display:none"></div>
          <form action="{{route('profesors.licCreate')}}" method="POST">
              @csrf
              <div class="form-row">
                <div class="form-group col-lg-12  col-md-6">
                  <label for="inputLicencia">Licencia</label>
                  <select class="form-select"  name="licfrm" id="licfrm">
                    <option value="">--Por favor seleccionar una opcion--</option>
                    @foreach($licencias as $lic)
                        <option value="{{ $lic->id }}">
                            {{ $lic->nombre }}
                        </option>
                
                    @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-12 col-md-6">
                  <label for="inputLicencia">Rol</label>
                  <select class="form-select"  name="rolfrm" id="rolfrm">
                    <option value="">--Por favor seleccionar una opcion--</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">
                            {{ $rol->nombre_rol }}
                        </option>
                
                    @endforeach
                    </select>
                </div>
                
                
                <div class="form-group col-lg-12 col-md-6">
                  <label for="inputDate">Fecha</label>
                  <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha"  />
                </div>
              </div>
              <div class="form-group col-md-6">
                  <input name="legajo" id="legajo" type="hidden" value="{{ $profesor->legajo }}"/>
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

      </div>
    <br>
    <div class="row input-daterange">
        <div class="col-md-4">
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date"  />
        </div>
        <div class="col-md-4">
            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date"  />
        </div>
        <div class="col-md-4">
            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
        </div>
    </div>
    <br>
    <div id="tableview">
    </div> 
</div>

<script>
    function deleteLic(data) {
    if(confirm("¿Desea confirmar la eliminacion de la licencia?")){
      var op ="";
        $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
        type: 'post',
       url:'{{ route("profesors.licDelete") }}',
       data:{
        'id_licencia':data, 
        'legajo':{{$profesor->legajo}} ,
       }
      ,
      success: function(data2){
        //REVISAR SI ES POSIBLE REUTILIZAR load_data (es inalcanzable al estar dentro del ready).
        /*op+='<table id="tableLic" class="table table-striped">';
        op+=' <thead><tr><th>Licencia</th><th>Fecha</th><th></th></tr></thead>';
        for(var i=0;i<data2.data.length;i++){
          op+='<tr>';
          op+='<td>'+data2.data[i].licencia+'</td><td>'+data2.data[i].fecha+'</td>';
          op+='<td onclick="deleteLic('+data2.data[i].id+')""> <button type="button" name="deletelic" id="deletelic" class="btn btn-danger fa fa-trash"></button></td>'
          op+='</tr>';
        }
         op+='</table>';*/
         $('#tableview').html(data2);
          alert('Licencia eliminada con éxito.');
       },
        error: function(){
          alert('Ha ocurrido un error en la transaccion.');
          console.log("Error Occurred");
        }
    });
            //alert('test ok');
        }
    }
    
    //General filter absents by date
    $(document).ready(function() {
        $('.input-daterange').datepicker({
     todayBtn:'linked',
     format:'yyyy-mm-dd',
     autoclose:true
    });
   
    load_data();
    function load_data(from_date = '', to_date = '')
    {
        var op ="";
      $.ajax ({
        headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
        },
       url:'{{ route("profesors.licFilterDate") }}',
       data:{
        'from_date':from_date, 
        'to_date':to_date,
        'legajo':{{$profesor->legajo}} ,
       }
      ,
      success: function(data2){
       /* op+='<table id="tableLic" class="table table-striped">';
        op+=' <thead><tr><th>Licencia</th><th>Fecha</th><th></th></tr></thead>';
        for(var i=0;i<data2.data.length;i++){
          op+='<tr>';
          op+='<td>'+data2.data[i].licencia+'</td><td>'+data2.data[i].fecha+'</td>';
          
          op+='<td onclick="deleteLic('+data2.data[i].id+')""> <button type="button" name="deletelic" id="deletelic" class="btn btn-danger fa fa-trash"></button></td>'
          op+='</tr>';
        }
         op+='</table>';
         $('#tableview').html(op);
          console.log(data2);*/
         $("#tableview").empty().html(data2);
       },
        error: function(){
          console.log("Error Occurred");
        }
    });
    };
    
    $('#filter').click(function(){
     var from_date = $('#from_date').val();
     var to_date = $('#to_date').val();
     if(from_date != '' &&  to_date != '')
     {
      $('#order_table').DataTable().destroy();
      load_data(from_date, to_date);
     }
     else
     {
      alert('Both Date is required');
     }
    });
   
    $('#refresh').click(function(){
     $('#from_date').val('');
     $('#to_date').val('');
     $('#order_table').DataTable().destroy();
     load_data();
    });
    });

    $("#btnCloseCreateLic").click(function () {
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal-backdrop").remove();
    $('#licModal').hide();
    });

    $('#btnLic').on('click',function(){
      $('#licModal').modal('show');
    })

  //SAVE FORM ABSENTS
    $(document).ready(function(){
            $('#formSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: "{{route('profesors.licCreate')}}",
                    method: 'post',
                    data: {
                      licencia: document.getElementById("licfrm").value,
                      rol: document.getElementById("rolfrm").value,
                      fecha: $('#fecha').val(), 
                      legajo: $('#legajo').val(), 
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
            });
        });


        $(document).ready(function(){

$(document).on('click', '.pagination a', function(event){
 event.preventDefault(); 
 var page = $(this).attr('href').split('page=')[1];
 fetch_data(page);
});

function fetch_data(page)
{
 $.ajax({
  url:"{{ route("profesors.licFilterDate") }}",
  data:{
        'page':page,
        'legajo':{{$profesor->legajo}} ,
       },
  success:function(data)
  {
   $('#tableview').html(data);
  }
 });
}

});
    </script>

@endsection


