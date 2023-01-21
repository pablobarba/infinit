@extends('layouts.app')
@section('title', 'HOME PHP')

@section('content')
    <div class="container">
        <h1>Generar Reporte</h1>
        <input type="text" class="form-control" id="txtdate" placeholder="Seleccione Fecha Semanal" />
        <div class="alert alert-danger" style="display:none"></div>
        <br>
        <div class="card p-3 bg-light">
            <div class="alert alert-warning " role="alert">
                Establecer dia semanal como feriado.
            </div>
            <div class="custom-control custom-switch">
                <div class="form-row">
                    <div class="form-group col-lg-12 col-md-6">
                        <input type="checkbox" class="custom-control-input" id="mondayFerFrm">
                        <label class="custom-control-label" for="mondayFerFrm">Lunes</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12 col-md-6">
                        <input type="checkbox" class="custom-control-input" id="tuesdayFerFrm">
                        <label class="custom-control-label" for="tuesdayFerFrm">Martes</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12 col-md-6">
                        <input type="checkbox" class="custom-control-input" id="wenesdayFerFrm">
                        <label class="custom-control-label" for="wenesdayFerFrm">Miercoles</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12 col-md-6">
                        <input type="checkbox" class="custom-control-input" id="thursdayFerFrm">
                        <label class="custom-control-label" for="thursdayFerFrm">Jueves</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12 col-md-6">
                        <input type="checkbox" class="custom-control-input" id="fridayFerFrm">
                        <label class="custom-control-label" for="fridayFerFrm">Viernes</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12 col-md-6">
                        <input type="checkbox" class="custom-control-input" id="saturdayFerFrm">
                        <label class="custom-control-label" for="saturdayFerFrm">Sabado</label>
                    </div>
                </div>
            </div>
        </div>
        <br>

        {{-- <button class="btn btn-danger fa fa-download" onClick="genReport()"></button> --}}

        <a class="btn btn-danger" onClick="genReport2(1)"><i class="fa fa-download"></i> Reporte de profesores </a>
        <a class="btn btn-primary" onClick="genReport2(0)"><i class="fa fa-download"></i> Reporte de auxiliares </a>
    </div>

    <script>
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

        function genReport2(repProf) {
            
            const feriados = {
                feriadoLunes:  ($('#mondayFerFrm').is(":checked")),
                feriadoMartes:  ($('#tuesdayFerFrm').is(":checked")),
                feriadoMiercoles: ($('#wenesdayFerFrm').is(":checked")),
                feriadoJueves: ($('#thursdayFerFrm').is(":checked")),
                feriadoViernes : ($('#fridayFerFrm').is(":checked")),
                feriadoSabado : ($('#saturdayFerFrm').is(":checked")),
                };
            $('.alert-danger').hide();
            $('#licModal').modal('hide');
            var dateSemFrm = document.getElementById("txtdate").value;

            if (dateSemFrm != "" && dateSemFrm != null) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    xhrFields: {
                        responseType: 'blob',
                    },
                    type: 'get',
                    url: '{{ route('report.getreport') }}',
                    data: {
                        'fecha_proceso': dateSemFrm,
                        'feriados': feriados,
                        'repProf': repProf,
                    },
                    success: function(result, status, xhr) {

                        var disposition = xhr.getResponseHeader('content-disposition');
                        var matches = /"([^"]*)"/.exec(disposition);
                        var filename = (matches != null && matches[1] ? matches[1] : dateSemFrm +
                            ' reportSem.xlsx');

                        // The actual download
                        var blob = new Blob([result], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;

                        document.body.appendChild(link);

                        link.click();
                        document.body.removeChild(link);

                    }
                });
            } else {
                $('.alert-danger').show();
                $('.alert-danger').append('<li>Se debe establecer dia semanal</li>');
            }
        }

        function genReport() {

            var dateSemFrm = document.getElementById("txtdate").value;
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: 'get',
                url: '{{ route('report.getreport') }}',
                data: {
                    'fecha_proceso': dateSemFrm,
                    'feriados': [],
                },
                success: function(result, status, xhr) {
                    alert('success excel downloaded');
                },
                error: function(data) {
                    alert('Ha ocurrido un error en la transaccion.');
                    console.log("Error Occurred: " + data);
                }
            });

        }
    </script>
@endsection
