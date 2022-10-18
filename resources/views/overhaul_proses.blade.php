@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Overhaul</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Proses Overhaul
                </h3>
                <!-- <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Master
                </button> -->
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>No. Mesin</th>
                            <th>Model</th>
                            <th>Serial Number</th>
                            <th>Asal</th>
                            <th>Mulai OH</th>
                            <th>Selesai OH</th>
                            <th>Teknisi</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">121</td>
                            <td>DC286</td>
                            <td>606718</td>
                            <td>Import</td>
                            <td>01-Nov-2022</td>
                            <td>15-Nov-2022</td>
                            <td>Wisnu</td>
                            <td class="text-center" style="width: 20%;">
                                <button type="button" class="btn btn-sm btn-secondary" onclick=ganti_data() data-bs-toggle="tooltip" title="Ganti Teknisi">
                                    <i class="fa fa-gear"></i>
                                </button>
                                <a href="{{ asset('design/cetakqr?SN=AGUS') }}" target="_blank" type="button" class="btn btn-sm btn-warning" onclick=qr_data() data-bs-toggle="tooltip" title="Cetak QR">
                                    <i class="fa fa-qrcode"></i>
                                </a>
                                <a href="{{ asset('design/prosesohform') }}" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah Item">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a href="{{ asset('design/prosesohdetail') }}" type="button" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick=selesai_data() data-bs-toggle="tooltip" title="Selesai">
                                    <i class="si si-like"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


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
                    <h3 class="block-title">Ganti Teknisi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="be_forms_elements.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="block-content fs-sm" id="body-modal">
                        <div class="row push">
                            <div class="col-lg-12 col-xl-12">
                                <div class="mb-4">
                                    <label class="form-label" for="example-text-input">Nama</label>
                                    <input type="text" class="form-control" id="example-text-input" name="example-text-input" value="select2 method">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-alt-primary" data-bs-dismiss="modal">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Normal Modal -->

<script>
    function selesai_data() {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda melaporkan bahwa proses overhaul mesin 120 - DC236 telah selesai!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Berhasil!',
                    'Menunggu persetujuan Supervisor untuk laporan overhaul.',
                    'success'
                )
            }
        })


    }

    function ganti_data() {
        // var html
        // var nama
        $('#exampleModalCenter').modal('show')
        // nama = '<h3 class="block-title">Bukti Ketidakhadiran - Agus Salim</h3>'
        // html = '<img src="{{ asset('media/leave/agus.jpg') }}" class="img-fluid" alt="bukti_leave">'
        // $('#body-modal').html(html)
        // $('.block-title').html(nama)
    }
</script>
@endsection