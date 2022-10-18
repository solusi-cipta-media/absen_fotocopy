@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Customer</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Customer
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Customer
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Klasifikasi</th>
                            <th>Contact Person</th>
                            <th>HP Contact</th>
                            <th>Lokasi</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">KLN-1</td>
                            <td>PT. ABC</td>
                            <td>Jl. Pramuka No. 48 Mangliawan Pakis Malang</td>
                            <td><span class="badge bg-success">Rental</span></td>
                            <td>Agus Salim</td>
                            <td>087654321</td>
                            <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                    <i class="fa fa-map"></i>
                                </button>
                            </td>
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
                <h3 class="block-title">Register Customer</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="be_forms_elements.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Kode</label>
                                <input type="text" class="form-control" id="example-text-input" name="example-text-input" value="KLN-1" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Nama</label>
                                <input type="email" class="form-control" id="example-email-input" name="example-email-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-textarea-input">Alamat</label>
                                <textarea class="form-control" id="example-textarea-input" name="example-textarea-input" rows="4"></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="example-email-input">Longitude</label>
                                    <input type="email" class="form-control" id="example-email-input" name="example-email-input">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-email-input">Latitude</label>
                                    <input type="email" class="form-control" id="example-email-input" name="example-email-input">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Klasifikasi</label>
                                <select class="form-select" id="example-select" name="example-select">
                                    <option value="1">Rental</option>
                                    <option value="2">Kontrak</option>
                                    <option value="2">Beli</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">Contact Person</label>
                                <input type="email" class="form-control" id="example-email-input" name="example-email-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-email-input">HP Contact Person</label>
                                <input type="email" class="form-control" id="example-email-input" name="example-email-input">
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