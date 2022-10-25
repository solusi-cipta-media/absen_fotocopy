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
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Nomor Induk Karyawan</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">Agus Salim</td>
                            <td>12345</td>
                            <td>05-Nov-2022</td>
                            <td>Cuti</td>
                            <td><span class="badge bg-danger">Approved</span></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success" onclick=show_data() data-bs-toggle="tooltip" title="Bukti">
                                    <i class="si si-picture"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" onclick=approve_data() data-bs-toggle="tooltip" title="Approve">
                                    <i class="fa fa-circle-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick=reject_data() data-bs-toggle="tooltip" title="Reject">
                                    <i class="fa fa-circle-xmark"></i>
                                </button>
                            </td>
                        </tr> --}}
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
                            <h3 class="block-title">Terms &amp; Conditions</h3>
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
                            <button type="button" class="btn btn-alt-primary" data-bs-dismiss="modal">
                                Done
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
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'nip', name: 'nip'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'cuti', name: 'cuti'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
            ]
        });
    })
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