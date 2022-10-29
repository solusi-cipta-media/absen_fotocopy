@extends('template.app')

@section('content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Absensi</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Report Absensi Harian
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-6">
                        <label for="date-filter" class="form-label">Filter tanggal</label>
                        <div class="flatpickr input-group mb-4" id="date-filter">
                            <input type="text" class="form-control" placeholder="Select Date.." data-input> <!-- input is mandatory -->
                            <div class="input-group-append">
                                <a class="input-button btn btn-outline-secondary" title="toggle" data-toggle>
                                    <i class="fa fa-calendar"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nomor Induk Karyawan</th>
                            <th>Nama</th>
                            <th>Clock IN</th>
                            <th>Clock OUT</th>
                            <th>Terlambat</th>
                            <th>Pulang Cepat</th>
                            <th style="width: 10%;">Lokasi IN</th>
                            <th style="width: 10%;">Lokasi OUT</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Normal Modal -->
        <div class="modal" id="modal_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Foto <span id="type"></span></h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm" id="body-modal">
                            <img src="" alt="foto" class="w-100">
                        </div>
                        <div class="block-content block-content-full block-content-sm text-end border-top">
                            <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Normal Modal -->
        <!-- Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

<script>
    var from;
    var to;
    $(document).ready(function () {  
        $('table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('absensi') }}",
            order: [[0, 'desc']],
            columns: [
                {data: 'tanggal', name: 'tanggal'},
                {data: 'nip', name: 'nip'},
                {data: 'nama', name: 'nama'},
                {data: 'clock_in', name: 'clock_in'},
                {data: 'clock_out', name: 'clock_out'},
                {data: 'terlambat', name: 'terlambat'},
                {data: 'pulang', name: 'pulang'},
                {data: 'lokasi_in', name: 'lokasi_in'},
                {data: 'lokasi_out', name: 'lokasi_out'}
            ]
        });

        $('.flatpickr').flatpickr({
            mode: "range",
            dateFormat: "d-F-Y",
            wrap : true,
            onChange: function(dates, dateStr) {
                if (dates.length == 2) {
                    filter(dateStr);
                }
            }
        });
    });
    
    function filter(dateRange) {
        var table = $('table').DataTable();
        var url = "{{ route('absensi.dateRange',':data') }}";
        url = url.replace(':data', dateRange);
        table.ajax.url(url).load();
    }
    
    function open_foto(id, tipe) {
        if (tipe === 'in') {
            console.log('in');
            $('#modal_foto #type').html('Clock In');
        }else{
            console.log('out');
            $('#modal_foto #type').html('Clock Out');
        }
        $('#modal_foto').modal('show');
        url = $('#link_'+tipe+id).attr('href');
        $('#modal_foto img').attr('src', url);
    }
</script>
@endsection