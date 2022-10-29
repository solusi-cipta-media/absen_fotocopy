@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Customer</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Customer
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick="open_form()">
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
                        
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add data form --}}
        <div class="block block-rounded" id="a-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title"><span id="form-header"></span> Customer</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" onclick="close_form()"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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
                                <button type="reset" class="btn btn-alt-danger" onclick="clear_form()"><i class="si si-close"></i> Clear</button>
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


    //Mostly change
    var list_element = $('#list'); //List
    var form_element = $('#a-form'); //Init form variable
    var form_header_element = $('#form-header'); //Text header
    var form_header_text = ['Register', 'Edit']; // Header for add or edit form
    var url_datatable = "{{ route('customer') }}"; //Index url
    var url_store = "{{route('customer.store')}}"; //Store/add url
    var url_get = "{{ route('customer.get', ':id') }}"; //Get one obj url 
    var url_update = "{{ route('customer.update', ':id') }}"; //Update url 
    var url_delete = "{{ route('customer.delete', ':id') }}"; //Delete url
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
    
    //show form
    function open_form(id) {
        if (id == null) {
            // For Add data
            generateCode();
            method = 'add';
            form_header_element.text(form_header_text[0]);
            form_element.find('input').val('');
            form_element.find('textarea').val('');
            form_element.find('option').removeAttr('selected');
            form_element.find('input[type="file"]').attr('required');
            form_element.find('#reset').attr('type', 'reset');
        }else{
            // For Edit data
            method = 'edit';
            save_id = id;
            form_header_element.text(form_header_text[1]);
            form_element.find('#reset').attr('type', 'button');
            form_element.find('input[type="file"]').removeAttr('required');
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
                        form_element.find('input[type="text"][name='+key+']').val(value);
                        form_element.find('input[type="number"][name='+key+']').val(value);
                        form_element.find('textarea[name='+key+']').val(value);
                        form_element.find('option[name='+key+']').removeAttr('selected');
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Gagal menambahkan data',
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Gagal mengubah data',
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
                        form_element.find('option[name='+key+']').removeAttr('selected');
                        form_element.find('select[name='+key+']').find('option[value='+value+']').attr('selected', 'selected');
                    });
                }
            });
        }else{
            generateCode();
        }
    }

    function generateCode() {
        $.ajaxSetup({
            headers: ajax_header
        });
        $.ajax({
            type : "GET",
            url : "{{ route('customer.code') }}",
            success : function (res) {
                form_element.find('#kode').val(res.data);
            }
        });
    }
</script>
@endsection