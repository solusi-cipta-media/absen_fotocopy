@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Cuti</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Jenis Cuti
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick="open_form()">
                    <i class="fa fa-plus mr-5"></i> Register Jenis Cuti
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Jenis Cuti</th>
                            <th>Waktu</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block block-rounded" id="a-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title"> <span id="form-header"></span> Jenis Cuti</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" onclick="close_form()"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="nama">Jenis Cuti</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="waktu">Jumlah Waktu</label>
                                <input type="number" class="form-control" id="waktu" name="waktu">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="reset" class="btn btn-alt-danger" id="reset" onclick="clear_form()"><i class="si si-close"></i> Clear</button>
                            </div>
                        </div>
                    </div>
                    
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
    var url_datatable = "{{ route('cuti') }}"; //Index url
    var url_store = "{{route('cuti.store')}}"; //Store/add url
    var url_get = "{{ route('cuti.get', ':id') }}"; //Get one obj url 
    var url_update = "{{ route('cuti.update', ':id') }}"; //Update url 
    var url_delete = "{{ route('cuti.delete', ':id') }}"; //Delete url
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
                {data: 'nama', name: 'nama'},
                {data: 'waktu', name: 'waktu'},
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
            form_element.find('#reset').attr('type', 'reset');
            form_element.find('option').removeAttr('selected');
        }else{
            // For Edit data
            method = 'edit';
            save_id = id;
            form_header_element.text(form_header_text[1]);
            form_element.find('#reset').attr('type', 'button');
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
                        form_element.find('option').removeAttr('selected');
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
        }
    }
</script>
@endsection