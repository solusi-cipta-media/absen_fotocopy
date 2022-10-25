@extends('template.app')
@section('content')
<!-- Main Container -->
<main id="main-container">
    @csrf
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Karyawan</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Karyawan Perusahaan
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Karyawan
                </button>
            </div>
            <div class="block-content block-content-full table-responsive">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                {{-- <table id="karyawan_table" class="table table-bordered table-striped table-vcenter js-dataTable-responsive"> --}}
                <table id="karyawan_table" class="table table-bordered table-striped table-vcenter w-100">
                        <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. KTP</th>
                            <th>Handphone</th>
                            <th>Jenis Kelamin</th>
                            <th>Photo</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">P001</td>
                            <td>Agus Salim</td>
                            <td>Jl. Pramuka No. 48 Mangliawan Pakis Malang</td>
                            <td>33502345638978</td>
                            <td>087654321</td>
                            <td>Laki-Laki</td>
                            <td>
                                <img class="img-avatar" src="{{asset('media/avatars/asa.jpg') }}" alt="">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger" onclick="delete_data()" data-bs-toggle="tooltip" title="Hapus">
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


        {{-- Modal Tambah Data --}}
        <div class="block block-rounded" id="add-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Register Karyawan</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide-add-form"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="nip">Nomor Induk Karyawan</label>
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="no_ktp">No. KTP</label>
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="telepon">Handphone</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="foto">Photo Karyawan</label>
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/png, image/jpeg" multiple required>
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

        {{-- Modal Edit Data --}}
        <div class="block block-rounded" id="edit-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Karyawan</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide-edit-form"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="nip">Nomor Induk Karyawan</label>
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="no_ktp">No. KTP</label>
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="telepon">Handphone</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="foto">Photo Karyawan</label>
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/png, image/jpeg" multiple>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="button" onclick="resetEdit()" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
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
        $('#karyawan_table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('karyawan') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nip', name: 'nip'},
                {data: 'nama', name: 'nama'},
                {data: 'alamat', name: 'alamat'},
                {data: 'no_ktp', name: 'no_ktp'},
                {data: 'telepon', name: 'telepon'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'foto', name: 'foto'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // tambah data karyawan
    $('#btn-add').on('click', function() {
        $('#add-form').show(500);
        $('#list-karyawan').hide();
    });

    $('#btn-hide-add-form').on('click', function() {
        $('#list-karyawan').show(500);
        $('#add-form').hide();
    });

    // edit data karyawan
    var save_id;
    function edit_data(id) {
        save_id = id;
        var url = "{{ route('karyawan.get', ':id') }}";
        var url = url.replace(':id', id);
        get(url);
        $('#edit-form').show(500);
        $('#list-karyawan').hide();
    }

    function resetEdit(){
        var url = "{{ route('karyawan.get', ':id') }}";
        var url = url.replace(':id', save_id);
        get(url);
    }

    function get(url) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type: 'GET',
            url : url,
            success : function (res) {
                $('#edit-form #nama').val(res.data.nama);
                $('#edit-form #nip').val(res.data.nip);
                $('#edit-form #alamat').val(res.data.alamat);
                $('#edit-form #no_ktp').val(res.data.no_ktp);
                $('#edit-form #telepon').val(res.data.telepon);
                $('#edit-form option').removeAttr('selected');
                $('#edit-form option[value='+res.data.jenis_kelamin+']').attr('selected','selected');
            }
        });
    }

    $('#btn-hide-edit-form').on('click', function() {
        $('#list-karyawan').show(500);
        $('#edit-form').hide();
    });


    // Add data
    $('#add-form form').on('submit', function (event) {
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        var url = "{{ route('karyawan.store') }}";
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                $('#add-form input').val('');
                $('#add-form textarea').val('');
                $('#add-form option').removeAttr('selected');
                table = $('#karyawan_table').DataTable();
                table.draw();
                Swal.fire(
                    'Created!',
                    'Data berhasil ditambahkan.',
                    'success'
                )
            },
            error : function (res) {
                var errors = res.responseJSON;
                var message;
                if (errors.errors.nip != null && errors.errors.no_ktp != null) {
                    message = 'Nomor Induk Karyawan dan Nomor KTP sudah terdaftar di karyawan lain'
                }else if (errors.errors.no_ktp != null) {
                    message = 'Nomor KTP sudah terdaftar di karyawan lain';
                }else if (errors.errors.nip != null){
                    message = 'Nomor Induk Karyawan sudah terdaftar di karyawan lain';
                }else if (errors.errors.foto != null){
                    message = 'Gambar yang dipilih tidak sesuai';
                }else{
                    message = 'Error tidak diketahui';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: message,
                });
            }
        });
    });

    // update data
    $('#edit-form form').on('submit', function (event) {
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        var url = "{{ route('karyawan.update', ':id') }}"
        url = url.replace(':id', save_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                var url = "{{ route('karyawan.get', ':id') }}";
                var url = url.replace(':id', save_id);
                get(url);
                table = $('#karyawan_table').DataTable();
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
                if (errors.errors.nip != null && errors.errors.no_ktp != null) {
                    message = 'Nomor Induk Karyawan dan Nomor KTP sudah terdaftar di karyawan lain'
                }else if (errors.errors.no_ktp != null) {
                    message = 'Nomor KTP sudah terdaftar di karyawan lain';
                }else if (errors.errors.nip != null){
                    message = 'Nomor Induk Karyawan sudah terdaftar di karyawan lain';
                }else if (errors.errors.foto != null){
                    message = 'Gambar yang dipilih tidak sesuai';
                }else{
                    message = 'Error tidak diketahui';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: message,
                });
            }
        });

        // $.ajaxSetup({
        //     headers :{
        //         'X-XSRF-TOKEN' : '{{ csrf_token() }}'
        //     }
        // });
        // $.ajax({
        //     type: 'PUT', 
        //     contentType: false,
        //     processData: false,
        //     cache:false,
        //     url: url,
        //     data: form,
            // success: function (res) {
            //     var url = "{{ route('karyawan.get', ':id') }}";
            //     var url = url.replace(':id', save_id);
            //     get(url);
            //     table = $('#karyawan_table').DataTable();
            //     table.draw();
            //     Swal.fire(
            //         'Updated!',
            //         'Data berhasil di update.',
            //         'success'
            //     )
            // }
        // });
    });


    // delete data karyawan
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
                var url = "{{ route('karyawan.delete', ':id') }}";
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
                        table = $('#karyawan_table').DataTable();
                        table.draw();
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil di hapus.',
                            'success'
                        )
                    },
                    error : function (res) {
                        
                    }
                });
            }
        })
    }
</script>
@endsection
