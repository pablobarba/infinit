@extends('layouts.app')
@section('title', 'HOME PHP')

@section('content')
    <div class="container">
        <h1>Licencias Generales</h1>

        <br>
        <div class="row input-daterange">
            <div class="col-md-4">
                <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
            </div>
            <div class="col-md-4">
                <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
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
        //General filter absents by date
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            load_data();
            function load_data(from_date = '', to_date = '') {
                var op = "";
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    url: '{{ route('licenciasgral.licGralFilterDate') }}',
                    data: {
                        'from_date': from_date,
                        'to_date': to_date,
                    },
                    success: function(data2) {
                        $("#tableview").empty().html(data2);
                    },
                    error: function() {
                        console.log("Error Occurred");
                    }
                });
            };

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
                load_data();
            });
        });

        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                $.ajax({
                    url: "{{ route('licenciasgral.licGralFilterDate') }}",
                    data: {
                        'from_date': from_date,
                        'to_date': to_date,
                        'page': page,
                    },
                    success: function(data) {
                        $('#tableview').html(data);
                    }
                });

            }

        });
    </script>

@endsection
