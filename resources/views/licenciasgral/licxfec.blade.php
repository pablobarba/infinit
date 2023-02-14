@extends('layouts.app')
@section('title', 'HOME PHP')

@section('content')
    <div class="container">
        <h1>Carga licencias por rango de fecha</h1>
        <div class="row input-daterange">
            <div class="col-md-4">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
            </div>
            <div class="col-md-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
            </div>
            <div class="col-md-4">
                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
            </div>
        </div>
        <br>
        <div class="row col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-danger" style="display:none">Completar todos los datos del formulario
                    (Fecha,Profesor,Rol,Licencia)</div>
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
                            <div id="selectLicenceBind">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success" id="sendDataBtn">Grabar Licencias</button>

                </form>
            </div>
        </div>
    </div>

    <script>
        let data2 = [];
        const formEl = document.querySelector("form");
        const tbodyEl = document.querySelector("tbody");
        const tableEl = document.querySelector("table");


        function onDeleteRow(e) {
            if (!e.target.classList.contains("deleteBtn")) {
                return;
            }

            const btn = e.target;
            btn.closest("tr").remove();
        }

        function saveLicXFec(e) {

            var from_date = document.getElementById("from_date").value;
            var to_date = document.getElementById("to_date").value;

            if ((from_date != null && from_date != "")
            && (to_date != null && to_date != "")
            && enableAdd()) {

                var profesor = document.getElementById("profesorFrm").value;
            var rol = document.getElementById("rolfrm").value;
            var licencias = document.getElementById("getLicencefrm").value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: "{{ route('licenciasgral.saveLicences') }}",
                    method: 'post',
                    data: {
                        profesor: profesor,
                        rolId: rol,
                        licenciaId: licencias,
                        fecha_from: from_date,
                        fecha_to: to_date,

                    },
                    success: function(result) {
                        //alert('Carga de licencias exitosa.');
                        //window.location.replace(result);
                        Swal.fire({
                                    title: "Éxito",
                                    text: "La licencia se cargo correctamente",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    showLoaderOnConfirm: true,
                                    preConfirm: () => {
                                        document.location.replace(result);
                                    }

                                });
                    },
                    error: function(data) {}
                });

                $('.alert-danger').hide();
            } else {
                $('.alert-danger').show();
            }

        }

        
        sendDataBtn.addEventListener("click", saveLicXFec);

        $(document).ready(function() {
            $('#formSubmit').click(function(e) {
                console.log('formSubmit');
                onAddWebsite();
            });
        });


        $(function() {
            var selectedDates = [];
            datePicker = $('[id*=txtdate]').datepicker({
                startDate: null,
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
                url: "{{ route('licenciasgral.getRolByProfesor') }}",
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

        function resetSelectElement(selectElement) {
            $("#profesorFrm").val('');
            $("#rolFrmlInner").remove();
            $("#getLicenceFrmlInner").remove();
            $('.alert-danger').hide();
        }

        function enableAdd() {
            if ((document.getElementById("profesorFrm") != null && document.getElementById("profesorFrm").value != '') &&
                (document.getElementById("rolfrm") != null && document.getElementById("rolfrm").value != '') &&
                (document.getElementById("getLicencefrm") != null && document.getElementById("getLicencefrm").value != '')
            ) {
                return true;
            } else {
                $('.alert-danger').show();
            }
        }



        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $('#order_table').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#order_table').DataTable().destroy();
            });
        });
    </script>
@endsection
