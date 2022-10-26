@extends('template.app')
@section('content')
<!-- Main Container -->
<main id="main-container">
    @csrf
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Karyawan</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Karyawan Perusahaan
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick="open_form()">
                    <i class="fa fa-plus mr-5"></i> Register Karyawan
                </button>
            </div>
            <div class="block-content block-content-full table-responsive">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
                        <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>No. KTP</th>
                            <th>Handphone</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Photo</th>
                            <th>Alamat</th>
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
        <div class="block block-rounded" id="a-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title"><span id="form-header"></span> Karyawan</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" onclick="close_form()"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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
                                <label class="form-label" for="no_ktp">No. KTP</label>
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" minlength="6" required>
                                <div class="form-check mt-2 ms-2">
                                    <input onclick="show_password()" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                      Tampilkan Password
                                    </label>
                                </div>    
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="role">Jabatan</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="teknisi">Teknisi</option>
                                    <option value="staff">Staff</option>
                                </select>
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
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label" for="foto">Photo Karyawan</label>
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/png, image/jpeg" multiple required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="button" class="btn btn-alt-danger" onclick="clear_form()" id="reset"><i class="si si-close"></i> Clear</button>
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
    function show_password() {
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text');
        }else{
            $('#password').attr('type', 'password');
        }
    }
    //Mostly change
    var list_element = $('#list'); //List
    var form_element = $('#a-form'); //Init form variable
    var form_header_element = $('#form-header'); //Text header
    var form_header_text = ['Register', 'Edit']; // Header for add or edit form
    var url_datatable = "{{ route('karyawan') }}"; //Index url
    var url_store = "{{route('karyawan.store')}}"; //Store/add url
    var url_get = "{{ route('karyawan.get', ':id') }}"; //Get one obj url 
    var url_update = "{{ route('karyawan.update', ':id') }}"; //Update url 
    var url_delete = "{{ route('karyawan.delete', ':id') }}"; //Delete url
    var ajax_header = {
            "X-CSRF-TOKEN" : "{{ csrf_token() }}"
        }; //Token
    // local variable
    var datatable_element = list_element.find('table'); //Init datatable variable
    var method = 'add'; //Method form ['add', 'edit'] 
    var save_id; //id for upload
    
    //Datatable
    $(document).ready(function () {
        datatable_element.DataTable({
            serverSide: true,
            responsive: true,
            ajax: url_datatable,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nip', name: 'nip'},
                {data: 'nama', name: 'nama'},
                {data: 'no_ktp', name: 'no_ktp'},
                {data: 'telepon', name: 'telepon'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'role', name: 'role'},
                {data: 'foto', name: 'foto'},
                {data: 'alamat', name: 'alamat'},
                {data: 'action', name: 'action'}
            ]
        });
    })
    
    //show form
    function open_form(id) {
        if (id == null) {
            // For Add data
            method = 'add';
            form_header_element.text(form_header_text[0]);
            form_element.find('input').val('');
            form_element.find('textarea').val('');
            form_element.find('option').removeAttr('selected');
            form_element.find('input[type="file"]').attr('required');
            form_element.find('input[type="password"]').attr('required');
            form_element.find('#reset').attr('type', 'reset');
        }else{
            // For Edit data
            method = 'edit';
            save_id = id;
            form_header_element.text(form_header_text[1]);
            form_element.find('#reset').attr('type', 'button');
            form_element.find('input[type="file"]').removeAttr('required');
            form_element.find('input[type="password"]').removeAttr('required');
            var url = url_get;
            url = url.replace(':id', id);
            $.ajaxSetup({
                headers: ajax_header
            });
            $.ajax({
                type:'GET',
                url : url,
                success : function(res) {
                    var items = res.data;
                    Object.entries(items).forEach(([key, value]) => {
                        form_element.find('input[type="email"][name='+key+']').val(value);
                        form_element.find('input[type="text"][name='+key+']').val(value);
                        form_element.find('input[type="number"][name='+key+']').val(value);
                        form_element.find('textarea[name='+key+']').val(value);
                        form_element.find('select[name='+key+'] option').removeAttr('selected');
                        form_element.find('select[name='+key+']').find('option[value='+value+']').attr('selected', 'selected');
                    });
                }
            });
        }
        form_element.show(500);
        list_element.hide();
    }

    function close_form() { 
        form_element.find('input').val('');
        form_element.find('textarea').val('');
        form_element.find('option').removeAttr('selected');
        list_element.show(500);
        form_element.hide();
    }

    form_element.find('form').on('submit', function (event) { 
        if (method == 'add') {
            //IF Method add || Add data
            event.preventDefault();
            var form = $(this)[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: ajax_header
            });
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: url_store,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    table = datatable_element.DataTable();
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
                    }else if(errors.errors.email != null){
                        message = 'Email sudah terdaftar di karyawan lain';
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
        }else if(method=='edit'){
            //IF Method Edit || Update data
            event.preventDefault();
            var url = url_update;
            url = url.replace(':id', save_id);
            var form = $(this)[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: ajax_header
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
                    table = datatable_element.DataTable();
                    table.draw();
                    Swal.fire(
                        'Created!',
                        'Data berhasil diubah.',
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
                    }else if(errors.errors.email != null){
                        message = 'Email sudah terdaftar di karyawan lain';
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
        }
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
                var url = url_delete;
                var url = url.replace(':id', id);
                $.ajaxSetup({
                    headers: ajax_header
                });
                $.ajax({
                    type : 'DELETE',
                    url : url,
                    success : function (res) {
                        table = datatable_element.DataTable();
                        table.draw();
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil dihapus.',
                            'success'
                        )
                    },
                    error : function (res) {
                        var errors = res.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Errors',
                            text: 'Gagal menghapus data',
                        });
                    }
                });
            }
        })
    }

    function clear_form() {
        if (method == 'edit') {
            var url = url_get;
            url = url.replace(':id', save_id);
            $.ajaxSetup({
                headers: ajax_header
            });
            $.ajax({
                type:'GET',
                url : url,
                success : function(res) {
                    var items = res.data;
                    Object.entries(items).forEach(([key, value]) => {
                        form_element.find('input[type="text"][name='+key+']').val(value);
                        form_element.find('input[type="number"][name='+key+']').val(value);
                        form_element.find('textarea[name='+key+']').val(value);
                        form_element.find('select[name='+key+'] option').removeAttr('selected');
                        form_element.find('select[name='+key+']').find('option[value='+value+']').attr('selected', 'selected');
                    });
                }
            });
        }
    }
</script>
@endsection
