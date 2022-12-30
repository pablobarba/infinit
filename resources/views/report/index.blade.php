@extends('layouts.app')
@section('title', 'HOME PHP')

@section('content')
    <div class="container">
        <h1>Carga masiva de licencias</h1>
        <input type="text" class="form-control" id="txtdate" placeholder="Seleccione Fecha Semanal" />
        <br>
        <div class="row col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="alert alert-danger" style="display:none">Completar todos los datos del formulario
                    (Profesor,Rol,Dia,Licencia)</div>
                <div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert"
                    style="display:none">
                    <strong>Datos agregados correctamente</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="inputProfesor">Profesor</label>
                            <select class="form-select" name="profesorFrm" id="profesorFrm">
                                <option value="">--Por favor seleccionar una opcion--</option>
                                @foreach ($profesors as $p)
                                    <option value="{{ $p->legajo }}">
                                        {{ $p->legajo }}: {{ $p->nombre }} {{ $p->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div id="selectRolBind">
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
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
                            <th scope="col">RolXP ID</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Dia</th>
                            <th scope="col">Licencia ID</th>
                            <th scope="col">Licencia</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <button type="button" disabled class="btn btn-success" id="sendDataBtn">Grabar Licencias</button>
            </div>
        </div>
    </div>

    <script>
        let data2 = [];
        const formEl = document.querySelector("form");
        const tbodyEl = document.querySelector("tbody");
        const tableEl = document.querySelector("table");

        function onAddWebsite(e) {

            if (enableAdd()) {
                const profesorFrm = document.getElementById("profesorFrm").value;
                const rolfrm = document.getElementById("rolfrm").value;
                const diafrm = document.getElementById("diafrm").value;
                const licenciafrm = document.getElementById("getLicencefrm").value;

                var rolTxt = document.getElementById("rolfrm");
                var textRol = rolTxt.options[rolTxt.selectedIndex].text;
                var licTxt = document.getElementById("getLicencefrm");
                var textLic = licTxt.options[licTxt.selectedIndex].text;

                document.getElementById("sendDataBtn").disabled = false;

                const obj = {
                    profesor: profesorFrm,
                    rolXPId: rolfrm,
                    rol: rolTxt,
                    dia: diafrm,
                    licenciaId: licenciafrm,
                    licencia: textLic
                };
                //data2.push(obj);

                tbodyEl.innerHTML += `
        <tr>
            <td>${profesorFrm}</td>
            <td>${rolfrm}</td>
            <td>${textRol}</td>
            <td>${diafrm}</td>
            <td>${licenciafrm}</td>
            <td>${textLic}</td>
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
            for (i = 1; i < rowLength; i++) {
                var oCells = oTable.rows.item(i).cells;
                var cellLength = oCells.length;
                $profesor = oCells.item(0).innerHTML;
                $rolId = oCells.item(1).innerHTML;
                $rol = oCells.item(2).innerHTML;
                $dia = oCells.item(3).innerHTML;
                $licenciaId = oCells.item(4).innerHTML;
                $licencia = oCells.item(5).innerHTML;

                const obj = {
                    profesor: $profesor,
                    rolId: $rolId,
                    rol: $rol,
                    dia: $dia,
                    licenciaId: $licenciaId,
                    licencia: $licencia
                };
                data2.push(obj);
            }
            var dateSemFrm = document.getElementById("txtdate");

            if ((dateSemFrm != null && dateSemFrm.value != '')) {
                var jsonData2 = JSON.stringify(data2);
                const dateSem = document.getElementById("txtdate").value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: "{{ route('report.saveLicences') }}",
                    method: 'post',
                    data: {
                        licencias: jsonData2,
                        fecha: dateSem,
                    },
                    success: function(result) {
                        alert('Ejecucion carga de licencias exitosa.');
                        window.location.replace(result);
                    },
                    error: function(data) {}
                });

                $('.alert-danger').hide();
            } else {
                $('.alert-danger').show();
            }

        }

        formEl.addEventListener("formSubmit", onAddWebsite);
        tableEl.addEventListener("click", onDeleteRow);
        sendDataBtn.addEventListener("click", generateReport);

        $(document).ready(function() {
            $('#formSubmit').click(function(e) {
                console.log('formSubmit');
                onAddWebsite();
            });
        });


        $(function() {
            var selectedDates = [];
            datePicker = $('[id*=txtdate]').datepicker({
                startDate: new Date(),
                minDate: 0,
                multidate: false,
                format: "mm/dd/yyyy",
                daysOfWeekHighlighted: "0,2,3,4,5,6",
                language: 'en',
                daysOfWeekDisabled: [0, 2, 3, 4, 5, 6]
            });
            datePicker.on('changeDate', function(e) {

            });
        });

        function fetch_data() {
            const profesorFrm = document.getElementById("profesorFrm").value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                }
            });
            $.ajax({
                url: "{{ route('report.getRolByProfesor') }}",
                data: {
                    'legajo': profesorFrm,
                },
                method: 'post',
                success: function(data) {
                    $('#selectRolBind').html(data);
                }
            });
        }
        document.getElementById('profesorFrm').addEventListener('change', function() {
            fetch_data();
        });

        function getViewDays(days) {
            var op = "";
            op += '<div id="dayFrmInner">';
            op += '<label for="inputDia">Dia</label>';
            op += '<select class="form-select"  name="diafrm" id="diafrm" >';
            op += ' <option value="">--Por favor seleccionar una opcion--</option>';
            for (var i = 0; i < days.length; i++) {
                op += '<option value=' + days[i] + '> ';
                op += days[i];
                op += '</option>';
            }
            op += '</div>';
            $('#selectDayBind').html(op);
        }

        function getViewLicence() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                }
            });
            $.ajax({
                url: "{{ route('licencias.getLicences') }}",
                data: {},
                method: 'post',
                success: function(data) {
                    $('#selectLicenceBind').html(data);
                }
            });
        }

        function getDays() {
            const days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
            const profesorFrm = document.getElementById("profesorFrm").value;
            const rolFrm = document.getElementById("rolfrm").value;
            /*
            FILTRAR DIAS QUE NO PERTENEZCAN AL ROL*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                }
            });
            $.ajax({
                url: "{{ route('profesors.getRolProfSemDay') }}",
                method: 'post',
                data: {
                    id_rol_prof: rolFrm,
                },
                success: function(result) {
                    console.log("getRolProfSemDay");
                    console.log(result);
                    if (result != null && result != undefined) {
                        if (result.lunes == 1) {
                            var index = days.indexOf('Lunes');
                            days.splice(index, 1);
                        }
                        if (result.martes == 1) {
                            var index = days.indexOf('Martes');
                            days.splice(index, 1);
                        }
                        if (result.miercoles == 1) {
                            var index = days.indexOf('Miercoles');
                            days.splice(index, 1);
                        }
                        if (result.jueves == 1) {
                            var index = days.indexOf('Jueves');
                            days.splice(index, 1);
                        }
                        if (result.viernes == 1) {
                            var index = days.indexOf('Viernes');
                            days.splice(index, 1);
                        }
                        if (result.sabado == 1) {
                            var index = days.indexOf('Sabado');
                            days.splice(index, 1);
                        }
                    }

                    var oTable = document.getElementById('report_table');
                    var isInItProf = false;
                    var isInItRol = false;
                    var op = "";
                    //gets rows of table
                    var rowLength = oTable.rows.length;


                    //loops through rows    
                    for (i = 1; i < rowLength; i++) {
                        isInIt = false;
                        isInItRol = false;
                        //gets cells of current row
                        var oCells = oTable.rows.item(i).cells;

                        //gets amount of cells of current row
                        var cellLength = oCells.length;

                        //loops through each cell in current row
                        var cellValProf = oCells.item(0).innerHTML;
                        var cellValRol = oCells.item(1).innerHTML;
                        var cellValDay = oCells.item(3).innerHTML;
                        if (cellValProf == profesorFrm && cellValRol == rolFrm) {
                            var index = days.indexOf(cellValDay);
                            if (index !== -1) {
                                days.splice(index, 1);
                            }
                            console.log(days);

                        }
                    }
                    getViewDays(days);
                    getViewLicence();

                },
                error: function(data) {}
            });


        }

        function resetSelectElement(selectElement) {
            $("#profesorFrm").val('');
            $("#rolFrmlInner").remove();
            $("#dayFrmInner").remove();
            $("#getLicenceFrmlInner").remove();
            $('.alert-danger').hide();
        }

        function enableAdd() {
            if ((document.getElementById("profesorFrm") != null && document.getElementById("profesorFrm").value != '') &&
                (document.getElementById("rolfrm") != null && document.getElementById("rolfrm").value != '') &&
                (document.getElementById("diafrm") != null && document.getElementById("diafrm").value != '') &&
                (document.getElementById("getLicencefrm") != null && document.getElementById("getLicencefrm").value != '')
            ) {
                return true;
            } else {
                $('.alert-danger').show();
            }
        }
    </script>
@endsection
