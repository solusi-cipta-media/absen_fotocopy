@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Absensi</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
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
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
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
                        <tr>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Normal Modal -->
<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
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
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
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


<script>
    function approve_data() {

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
                Swal.fire(
                    'Approved!',
                    'Pengajuan telah disetujui',
                    'success'
                )
            }
        })


    }

    function reject_data() {

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
                Swal.fire(
                    'Rejected!',
                    'Pengajuan telah ditolak',
                    'success'
                )
            }
        })


    }

    function show_data() {
        var html
        var nama
        $('#exampleModalCenter').modal('show')
        nama = '<h3 class="block-title">Bukti Ketidakhadiran - Agus Salim</h3>'
        html = '<img src="{{ asset('media/leave/agus.jpg') }}" class="img-fluid" alt="bukti_leave">'
        $('#body-modal').html(html)
        $('.block-title').html(nama)
    }
</script>
@endsection