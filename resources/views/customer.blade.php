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
                <table id="customer_table"class="table table-bordered table-striped table-vcenter">
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
                        {{-- <tr>
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
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add data form --}}
        <div class="block block-rounded" id="add-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Register Customer</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data" >
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="kode">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="klasifikasi">Klasifikasi</label>
                                <select class="form-select" id="klasifikasi" name="klasifikasi" required>
                                    <option value="rental">Rental</option>
                                    <option value="kontrak">Kontrak</option>
                                    <option value="beli">Beli</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="kontak_nama">Contact Person</label>
                                <input type="text" class="form-control" id="kontak_nama" name="kontak_nama">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="kontak_telepon">HP Contact Person</label>
                                <input type="text" class="form-control" id="kontak_telepon" name="kontak_telepon">
                            </div>

                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="reset" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
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


        {{-- Edit Data FOrm --}}
        <div class="block block-rounded" id="edit-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Customer</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide-edit"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data" >
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="kode">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="klasifikasi">Klasifikasi</label>
                                <select class="form-select" id="klasifikasi" name="klasifikasi" required>
                                    <option value="rental">Rental</option>
                                    <option value="kontrak">Kontrak</option>
                                    <option value="beli">Beli</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="kontak_nama">Contact Person</label>
                                <input type="text" class="form-control" id="kontak_nama" name="kontak_nama">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="kontak_telepon">HP Contact Person</label>
                                <input type="text" class="form-control" id="kontak_telepon" name="kontak_telepon">
                            </div>

                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="reset" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
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
    $(document).ready(function () {
        $('#customer_table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('customer') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'nama', name: 'nama'},
                {data: 'alamat', name: 'alamat'},
                {data: 'klasifikasi', name: 'klasifikasi'},
                {data: 'kontak_nama', name: 'kontak_nama'},
                {data: 'kontak_telepon', name: 'kontak_telepon'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'action', name: 'action'}
            ]
        });
    })

    function generateCode() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type : "GET",
            url : "{{ route('customer.code') }}",
            success : function (res) {
                $('#add-form #kode').val(res.data);
            }
        });
    }
    $('#btn-add').on('click', function() {
        generateCode();
        $('#add-form').show(500);
        $('#list-karyawan').hide();
    });

    $('#add-form form').on('submit', function (event){
        event.preventDefault();
        $.ajax({
            type:'POST',
            url : "{{route('customer.store')}}",
            data : $(this).serializeArray(),
            success : function (res) {
                $('#add-form input').val('');
                $('#add-form textarea').val('');
                $('#add-form option').removeAttr('selected');
                var table = $('#customer_table').DataTable();
                table.draw();
                Swal.fire(
                    'Created!',
                    'Data berhasil di tambahkan.',
                    'success'
                )
                generateCode();
            },
            error : function (res) {  
                var errors = res.responseJSON;
                var message;
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Data yang dikirim tidak sesuai'
                });
            }
        });
    });

    $('#btn-hide').on('click', function() {
        $('#list-karyawan').show(500);
        $('#add-form').hide();
    });

    $('#btn-hide-edit').on('click', function() {
        $('#list-karyawan').show(500);
        $('#edit-form').hide();
    });

    var save_id;
    function edit_data(id){
        save_id = id;
        var url = "{{ route('customer.get',':id') }}";
        url = url.replace(':id', id);
        console.log(url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type : "GET",
            url : url,
            success : function (res) {
                $('#edit-form #kode').val(res.data.kode);
                $('#edit-form #nama').val(res.data.nama);
                $('#edit-form #alamat').val(res.data.alamat);
                $('#edit-form #latitude').val(res.data.latitude);
                $('#edit-form #longitude').val(res.data.longitude);
                $('#edit-form option').removeAttr('selected');
                $('#edit-form option[value='+res.data.klasifikasi+']').attr('selected','selected');
                $('#edit-form #kontak_nama').val(res.data.kontak_nama);
                $('#edit-form #kontak_telepon').val(res.data.kontak_telepon);
            }
        });
        $('#edit-form').show(500);
        $('#list-karyawan').hide();
    }

    $('#edit-form form').on('submit', function (event){
        event.preventDefault();
        var url = "{{ route('customer.get',':id') }}";
        url = url.replace(':id', save_id);
        $.ajax({
            type:'POST',
            url : url,
            data : $(this).serializeArray(),
            success : function (res) {
                var table = $('#customer_table').DataTable();
                table.draw();
                Swal.fire(
                    'Updated!',
                    'Data berhasil di update.',
                    'success'
                )
            },
            error : function (res) {  
                var errors = res.responseJSON;
                var message;
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Data yang dikirim tidak sesuai'
                });
            }
        });
    });


    function delete_data(id) {
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
                var url = "{{ route('customer.delete', ':id') }}";
                var url = url.replace(':id', id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    type : 'DELETE',
                    url : url,
                    success : function (res) {
                        table = $('#customer_table').DataTable();
                        table.draw();
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil di hapus.',
                            'success'
                        )
                    }
                });
            }
        })


    }
</script>
@endsection