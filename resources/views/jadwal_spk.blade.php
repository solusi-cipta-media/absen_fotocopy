@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Kerja Luar</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    List SPK (Surat Perintah Kerja)
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick=register_data()>
                    <i class="fa fa-plus mr-5"></i> Register SPK
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Customer</th>
                            <th>Jenis</th>
                            <th>Tgl Kerja</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Teknisi</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">PT. ABC</td>
                            <td><span class="badge bg-success">Servis</span></td>
                            <td>22-Oct-2022</td>
                            <td class="text-center">Jl. Pramuka No. 48 Malang<br>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Maps">
                                    <i class="fa fa-location-dot"></i>
                                </button>
                            </td>
                            <td>-</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary" onclick=pilih_data() data-bs-toggle="tooltip" title="Pilih">
                                    <i class="fa fa-circle-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" id="btn-add" data-bs-toggle="tooltip" title="Pilih Teknisi">
                                    <i class="fa fa-user-gear"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="fw-semibold">PT. XYZ</td>
                            <td><span class="badge bg-danger">Instal</span></td>
                            <td>22-Oct-2022</td>
                            <td class="text-center">Jl. Pramuka No. 48 Malang<br>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Maps">
                                    <i class="fa fa-location-dot"></i>
                                </button>
                            </td>
                            <td>-</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary" id="btn-add" data-bs-toggle="tooltip" title="Pilih">
                                    <i class="fa fa-circle-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" id="btn-add" data-bs-toggle="tooltip" title="Pilih Teknisi">
                                    <i class="fa fa-user-gear"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="fw-semibold">PT. YCR</td>
                            <td><span class="badge bg-primary">Invoice</span></td>
                            <td>22-Oct-2022</td>
                            <td class="text-center">Jl. Pramuka No. 48 Malang<br>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Maps">
                                    <i class="fa fa-location-dot"></i>
                                </button>
                            </td>
                            <td>-</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary" onclick=pilih_data() data-bs-toggle="tooltip" title="Pilih">
                                    <i class="fa fa-circle-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" id="btn-add" data-bs-toggle="tooltip" title="Pilih Teknisi">
                                    <i class="fa fa-user-gear"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block block-rounded" id="add-new" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Pilih Teknisi</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="be_forms_elements.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Teknisi</label>
                                <input type="text" class="form-control" id="example-text-input" name="example-text-input" value="select2 method">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="button" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row push">
                    <div class="col-lg-12 col-xl-12">
                        <div class="mb-4">
                            <small style="text-decoration: underline;"><strong>Rincian Pekerjaan</strong></small>
                        </div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-lg-1">
                                    1
                                </div>
                                <div class="col-lg-4">
                                    PT. ABC
                                </div>
                                <div class="col-lg-3">
                                    22-Oct-2022
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1">
                                    2
                                </div>
                                <div class="col-lg-4">
                                    PT. XYZ
                                </div>
                                <div class="col-lg-3">
                                    22-Oct-2022
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" value="2">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-info">
                                <i class="si si-cloud-upload"></i> Update
                            </button>
                        </div>
                    </div>
                </div>
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
                    <h3 class="block-title">Register Pekerjaan</h3>
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
                                    <label class="form-label" for="example-text-input">Customer</label>
                                    <input type="text" class="form-control" id="example-text-input" name="example-text-input" value="select2 method">
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12">
                                <div class="mb-4">
                                    <label class="form-label" for="example-text-input">Waktu Kerja</label>
                                    <input type="date" class="form-control" id="example-text-input" name="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12">
                                <div class="mb-4">
                                    <label class="form-label" for="example-email-input">Jenis Pekerjaan</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option value="1">Servis</option>
                                        <option value="2">Instal</option>
                                        <option value="3">Invoice</option>
                                    </select>
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
    $('#btn-add').on('click', function() {
        $('#add-new').show(500);
        $('#list-karyawan').hide();
    });

    $('#btn-hide').on('click', function() {
        $('#list-karyawan').show(500);
        $('#add-new').hide();
    });

    $('#btn-edit').on('click', function() {
        $('#add-new').show(500);
        $('#list-karyawan').hide();
    });

    function pilih_data() {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan memilih mesin 120 - DC236 untuk Overhaul!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Berhasil!',
                    'Menunggu persetujuan Supervisor untuk proses overhaul.',
                    'success'
                )
            }
        })


    }

    function register_data() {
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