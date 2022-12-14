@extends('layouts.app')
@section('title','HOME PHP')

@section('content')
    <div class="container"> 
      <input type="text" class="form-control"  id="txtdate" placeholder="Seleccione Fecha Semanal"/>
      <br>
      <div class="row col-lg-12 col-md-12 col-sm-12">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="alert alert-danger" style="display:none">Completar todos los datos del formulario (Profesor,Rol,Dia,Licencia)</div>
          <form action="{{route('profesors.licCreate')}}" method="POST">
              @csrf
              <div class="form-row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <label for="inputProfesor">Profesor</label>
                  <select class="form-select"  name="profesorFrm" id="profesorFrm">
                      <option value="">--Por favor seleccionar una opcion--</option>
                      @foreach($profesors as $p)
                      <option value="{{ $p->legajo }}">
                        {{ $p->legajo }}: {{ $p->nombre }} {{ $p->apellido }}
                      </option>
              
                  @endforeach
                     {{-- <option value="36718500">Pablo Barba</option>--}}
                  </select>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  {{--<select class="form-select"  name="rolfrm" id="rolfrm" >
                      <option value="">--Por favor seleccionar una opcion--</option>
                      <option value="Rol1">Rol1</option>
                      <option value="Rol2">Rol2</option>
                      <option value="Rol3">Rol3</option>
                  </select>--}}
                  <div id="selectRolBind">
                  </div> 
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  {{--<label for="inputDia">Dia</label>
                  <select class="form-select"  name="diafrm" id="diafrm" >
                      <option value="">--Por favor seleccionar una opcion--</option>
                      <option value="Lunes">lunes</option>
                      <option value="Martes">martes</option>
                      <option value="Miercoles">miercoles</option>
                      <option value="Jueves">jueves</option>
                      <option value="Viernes">viernes</option>
                      <option value="Sabado">sabado</option>
                  </select>--}}
                  <div id="selectDayBind">
                  </div> 
                </div>
                
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <div id="selectLicenceBind">
                  </div> 
                </div>
              </div>
              <br>
                  <button type="button" class="btn btn-primary" id="formSubmit">Agregar >></button>
             
            </form>
          </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-striped table-dark" name="report_table" id="report_table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Profesor</th>
              <th scope="col">Rol</th>
            <th scope="col">Dia</th>
            <th scope="col">Licencia</th>
            <th scope="col"></th>
            </tr>
          </thead>
        <tbody>
      {{--@foreach ($lxps as $l)
      <tr>
          <td>{{$l->licencia}}</td>
          <td>{{$l->fecha}}</td>
          <td onclick="deleteLic({{$l->id}})"> <button type="button" name="deletelic" id="deletelic" class="btn btn-danger fa fa-trash"></button></td>
          
        </tr>
      @endforeach--}}
      
       
      </tbody>
      </table>

      <button type="button" disabled class="btn btn-success" id="sendDataBtn">Generar Reporte</button>
      </div>

</div>
</div> 

<script>
  
  let data2 = [];
  const formEl = document.querySelector("form");
  const tbodyEl = document.querySelector("tbody");
  const tableEl = document.querySelector("table");
  function onAddWebsite(e) {
    
    if(enableAdd()){
      const profesorFrm = document.getElementById("profesorFrm").value;
    const rolfrm = document.getElementById("rolfrm").value;
    const diafrm = document.getElementById("diafrm").value;
    const licenciafrm = document.getElementById("licenciafrm").value;

    document.getElementById("sendDataBtn").disabled = false;
    
    const obj = {profesor:profesorFrm,rol:rolfrm,dia:diafrm,licencia:licenciafrm};
    //data2.push(obj);

    tbodyEl.innerHTML += `
        <tr>
            <td>${profesorFrm}</td>
            <td>${rolfrm}</td>
            <td>${diafrm}</td>
            <td>${licenciafrm}</td>
            <td><button class="deleteBtn">Delete</button></td>
        </tr>
    `;
    resetSelectElement();
  }
  }

  function onDeleteRow(e) {
    if (!e.target.classList.contains("deleteBtn")) {
      return;
    }

    const btn = e.target;
    btn.closest("tr").remove();
  }

  function generateReport(e) {
data2 = [];
var oTable = document.getElementById('report_table');

var rowLength = oTable.rows.length;
for (i = 1; i < rowLength; i++)
{
   var oCells = oTable.rows.item(i).cells;
   var cellLength = oCells.length;
   $profesor       = oCells.item(0).innerHTML;  
   $rol       = oCells.item(1).innerHTML;
   $dia     = oCells.item(2).innerHTML;
   $licencia     = oCells.item(3).innerHTML;

   const obj = {profesor: $profesor,rol:$rol , dia:$dia , licencia:$licencia };
   data2.push(obj);
}
var jsonData2 = JSON.stringify(data2);
const dateSem = document.getElementById("txtdate").value;

$.ajaxSetup({
                    headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: "{{route('report.createReport')}}",
                    method: 'post',
                    data: {
                      licencia: jsonData2,
                      fecha: dateSem,
                    },
                    success: function(result){
                        
                    },
                    error :function( data ) {
                    }
                });

  }

  formEl.addEventListener("formSubmit", onAddWebsite);
  tableEl.addEventListener("click", onDeleteRow);
  sendDataBtn.addEventListener("click", generateReport);

  $(document).ready(function(){
            $('#formSubmit').click(function(e){
              console.log('formSubmit');
              onAddWebsite();
            });
        });


        $(function () {
            var selectedDates = [];
            datePicker = $('[id*=txtdate]').datepicker({
                startDate: new Date(),
                minDate: 0,
                multidate: false,
                format: "mm/dd/yyyy",
                daysOfWeekHighlighted: "0,2,3,4,5,6",
                language: 'en',
                daysOfWeekDisabled: [0,2,3,4,5,6]
            });
            datePicker.on('changeDate', function (e) {
                
            });
        });

function fetch_data()
{
  const profesorFrm = document.getElementById("profesorFrm").value;
  $.ajaxSetup({
                    headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
 $.ajax({
  url:"{{ route("report.getRolByProfesor") }}",
  data:{
        'legajo':profesorFrm,
       },
  method: 'post',
  success:function(data)
  {
   $('#selectRolBind').html(data);
  }
 });
}
document.getElementById('profesorFrm').addEventListener('change', function() {
  fetch_data();
});
/*
document.getElementById('rolfrm').addEventListener('change', function() {
  console.log('test');
  //fetch_data();
});*/
function getViewDays(days)
{
  var op ="";
  op+='<div id="dayFrmInner">';
  op+='<label for="inputDia">Dia</label>';
      op+='<select class="form-select"  name="diafrm" id="diafrm" >';
        op+=' <option value="">--Por favor seleccionar una opcion--</option>';
        for(var i=0;i<days.length;i++){
          op+='<option value='+days[i]+'> ';
          op+=days[i];
          op+='</option>';
        }
         op+='</div>';
         $('#selectDayBind').html(op);
}
function getViewLicence()
{
  var op ="";
  op+='<div id="licenceFrmInner">';
    op+='<label for="inputLicencia">Licencia</label>';
    op+='<input type="text" name="licenciafrm" id="licenciafrm" class="form-control" placeholder="Licencia"  />';
         $('#selectLicenceBind').html(op);  

}

function getDays()
{
  const days  = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] ;
  const profesorFrm = document.getElementById("profesorFrm").value;
  const rolFrm = document.getElementById("rolfrm").value;
  var oTable = document.getElementById('report_table');
  var isInItProf = false;
  var isInItRol = false;
  var op ="";
  //gets rows of table
var rowLength = oTable.rows.length;


//loops through rows    
for (i = 1; i < rowLength; i++){
  isInIt = false;
  isInItRol = false;
   //gets cells of current row
   var oCells = oTable.rows.item(i).cells;

   //gets amount of cells of current row
   var cellLength = oCells.length;

   //loops through each cell in current row
   var cellValProf = oCells.item(0).innerHTML;
   var cellValRol = oCells.item(1).innerHTML;
   var cellValDay = oCells.item(2).innerHTML;
   if(cellValProf == profesorFrm && cellValRol == rolFrm)
   {
    var index = days.indexOf(cellValDay);
    if (index !== -1) {
      days.splice(index, 1);
    }
      console.log(days);
      
   }
}
getViewDays(days);
getViewLicence();
}

function resetSelectElement(selectElement) {
  $("#profesorFrm").val('');
  $("#rolFrmlInner").remove();
  $("#dayFrmInner").remove();
  $("#licenceFrmInner").remove();
  $('.alert-danger').hide();
}
/*
document.getElementById("licenciafrm").addEventListener("keyup", enableAdd);*/
function enableAdd() {
  /*const test = document.getElementById("licenciafrm");
  const licenceFrm = document.getElementById("licenciafrm").value;
  const profesorFrm = document.getElementById("profesorFrm").value;
  const rolFrm = document.getElementById("rolfrm").value;
  const diafrm = document.getElementById("diafrm").value;
*/
  if((document.getElementById("profesorFrm")!=null&& document.getElementById("profesorFrm").value!='') 
  && (document.getElementById("rolfrm")!=null&& document.getElementById("rolfrm").value!='')
  && (document.getElementById("diafrm")!=null&& document.getElementById("diafrm").value!='')
  && (document.getElementById("licenciafrm")!=null&& document.getElementById("licenciafrm").value!='')
  ){
    return true;
  }
  else{
    $('.alert-danger').show();
  }
}

</script>
      @endsection