@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Mesin</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Mesin
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Master
                </button>
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
                            <th>Meter</th>
                            <th>Tegangan</th>
                            <th>Status</th>
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
                            <td>2734</td>
                            <td>220V</td>
                            <td><span class="badge bg-warning">Import</span></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger" onclick=delete_data() data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Edit" id="btn-edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block block-rounded" id="add-new" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Register Mesin</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="be_forms_elements.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Nomor Mesin</label>
                                <input type="text" class="form-control" id="example-text-input" name="example-text-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Serial Number</label>
                                <input type="text" class="form-control" id="example-email-input" name="example-email-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-textarea-input">Model</label>
                                <input type="text" class="form-control" id="example-email-input" name="example-email-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Asal</label>
                                <select class="form-select" id="example-select" name="example-select">
                                    <option value="1">Import</option>
                                    <option value="1">EX-Customer</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Meter</label>
                                <input type="text" class="form-control" id="example-email-input" name="example-email-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Tegangan</label>
                                <input type="text" class="form-control" id="example-email-input" name="example-email-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Status</label>
                                <select class="form-select" id="example-select" name="example-select">
                                    <option value="1">Import</option>
                                    <option value="1">Overhaul</option>
                                    <option value="2">Ready</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="button" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row-push">
                        <div class="col-lg-12 col-xl-12">
                            <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                            <button type="button" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
        <!-- Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

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

    function delete_data() {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Data berhasil di hapus.',
                    'success'
                )
            }
        })


    }
</script>
@endsection