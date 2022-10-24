@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Mesin</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Mesin
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick="open_form()">
                    <i class="fa fa-plus mr-5"></i> Register Mesin
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
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
                        {{-- <tr>
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
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block block-rounded" id="a-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title"><span id="form-header"></span> Mesin</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" onclick="close_form()"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data" >
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="nomor">Nomor Mesin</label>
                                <input type="text" class="form-control" id="nomor" name="nomor" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="serial">Serial Number</label>
                                <input type="text" class="form-control" id="serial" name="serial" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="asal">Asal</label>
                                <select class="form-select" id="asal" name="asal" required>
                                    <option value="import">Import</option>
                                    <option value="ex-customer">EX-Customer</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="meter">Meter</label>
                                <input type="number" class="form-control" id="meter" name="meter" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="tegangan">Tegangan</label>
                                <input type="text" class="form-control" id="tegangan" name="tegangan" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="import">Import</option>
                                    <option value="overhaul">Overhaul</option>
                                    <option value="ready">Ready</option>
                                </select>
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
    var url_datatable = "{{ route('mesin') }}"; //Index url
    var url_store = "{{route('mesin.store')}}"; //Store/add url
    var url_get = "{{ route('mesin.get', ':id') }}"; //Get one obj url 
    var url_update = "{{ route('mesin.update', ':id') }}"; //Update url 
    var url_delete = "{{ route('mesin.delete', ':id') }}"; //Delete url
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
                {data: 'nomor', name: 'nomor'},
                {data: 'model', name: 'model'},
                {data: 'serial', name: 'serial'},
                {data: 'asal', name: 'asal'},
                {data: 'meter', name: 'meter'},
                {data: 'tegangan', name: 'tegangan'},
                {data: 'status', name: 'status'},
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
                    var message;
                    if (errors.errors.nomor != null && errors.errors.serial != null) {
                        message = 'Nomor Mesin dan Serial Number sudah terdaftar di mesin lain';
                    }else if (errors.errors.serial != null) {
                        message = 'Serial Number sudah terdaftar di mesin lain';
                    }else if (errors.errors.nomor != null){
                        message = 'Nomor Mesin sudah terdaftar di mesin lain';
                    }else{
                        message = 'Error tidak diketahui'
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
                    if (errors.errors.nomor != null && errors.errors.serial != null) {
                        message = 'Nomor Mesin dan Serial Number sudah terdaftar di mesin lain';
                    }else if (errors.errors.serial != null) {
                        message = 'Serial Number sudah terdaftar di mesin lain';
                    }else if (errors.errors.nomor != null){
                        message = 'Nomor Mesin sudah terdaftar di mesin lain';
                    }else{
                        message = 'Error tidak diketahui'
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
                        form_element.find('option[name='+key+']').removeAttr('selected');
                        form_element.find('select[name='+key+']').find('option[value='+value+']').attr('selected', 'selected');
                    });
                }
            });
        }
    }

</script>
@endsection