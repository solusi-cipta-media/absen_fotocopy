@extends('template.app')

@section('content')
<style>
    .modal-header{
        padding: 1rem 1rem 0.3rem 1rem;
    }
    .modal-footer{
        padding: 0.1rem 1rem 0.5rem 1rem;
    }
    .modal-body{
        padding: 0;
        padding-top: 1rem;
        margin-bottom: 0.5rem;
    }
    .modal-body>div{
        padding: 5px;
    }
</style>
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Absensi</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Report Ketidakhadiran
                </h3>
                <!-- <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Kontrak
                </button> -->
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
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Normal Modal -->
        <div class="modal" id="modal_bukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Bukti Pengajuan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm" id="body-modal">
                            <img src="" alt="bukti-pengajuan" class="w-100">
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
    var ajax_header = {
            "X-CSRF-TOKEN" : "{{ csrf_token() }}"
        }; //Token

    $(document).ready(function () {  
        $('table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('absensi_ketidakhadiran') }}",
            order : [[0, 'desc']],
            columns: [
                {data: 'tanggal', name: 'tanggal'},
                {data: 'nip', name: 'nip'},
                {data: 'nama', name: 'nama'},
                {data: 'cuti', name: 'cuti'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
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
        var url = "{{ route('absensi_ketidakhadiran.dateRange',':data') }}";
        url = url.replace(':data', dateRange);
        table.ajax.url(url).load();
    }

    function approve_data(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menyetujui pengajuan ketidakhadiran karyawan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, setujui!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ route('absensi_ketidakhadiran.approve', ':id') }}";
                var url = url.replace(':id', id);
                $.ajaxSetup({
                    headers: ajax_header
                });
                $.ajax({
                    type : 'GET',
                    url : url,
                    success : function (res) {
                        table = $('table').DataTable();
                        table.draw();
                        Swal.fire(
                            'Approved!',
                            'Pengajuan telah disetujui',
                            'success'
                        )
                    },
                    error : function (res) {
                        var errors = res.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Errors',
                            text: 'Gagal menyetujui pengajuan',
                        });
                    }
                });
            }
        })
    }

    function reject_data(id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menolak pengajuan ketidakhadiran karyawan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tolak!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ route('absensi_ketidakhadiran.reject', ':id') }}";
                var url = url.replace(':id', id);
                $.ajaxSetup({
                    headers: ajax_header
                });
                $.ajax({
                    type : 'GET',
                    url : url,
                    success : function (res) {
                        table = $('table').DataTable();
                        table.draw();
                        Swal.fire(
                            'Rejected!',
                            'Pengajuan telah ditolak',
                            'success'
                        )
                    },
                    error : function (res) {
                        var errors = res.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Errors',
                            text: 'Gagal menolak pengajuan',
                        });
                    }
                });
            }
        })


    }

    function open_bukti(id) {
        $('#modal_bukti').modal('show');
        url = $('#link_bukti'+id).attr('href');
        $('#modal_bukti img').attr('src', url);
    }
</script>
@endsection