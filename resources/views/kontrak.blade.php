@extends('template.app')

@section('content')

<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #d8dde5;
        padding: 1.1rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
    margin-top: -0.8rem;

    margin-left: -0.8rem;

    }

    .modal-header{
        padding: 1rem 1rem 0.3rem 1rem;
    }

    .modal-footer{
        padding: 0.1rem 1rem 0.5rem 1rem;
    }

    .modal-body{
        padding: 0;
        padding-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .modal-body>div{
        padding: 5px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow{
        margin-top: 0.3rem;
        margin-right: 0.5rem;
    }
</style>

    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Kontrak</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Kontrak
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick="open_form()">
                    <i class="fa fa-plus mr-5"></i> Register Kontrak
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nomor</th>
                            <th>Customer</th>
                            <th>Awal Kontrak</th>
                            <th>Akhir Kontrak</th>
                            <th>Reminder</th>
                            <th>Dokumen</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">12345</td>
                            <td>PT. ABC</td>
                            <td>05-Nov-2022</td>
                            <td>05-Nov-2023</td>
                            <td>05-Oct-2023</td>
                            <td><button type="button" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Lihat</button></td>
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

        {{-- Modal PDF viewer --}}
        <div class="modal" id="modal_pdf" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg rounded" style="background-color:whitesmoke;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Dokumen Kontrak</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="border border-dark border-top border-bottom">
                        <iframe src="" frameborder="0" class="w-100" style="height: 450px"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>

        <div class="block block-rounded" id="a-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title"><span id="form-header"></span> Kontrak</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" onclick="close_form()"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data" >
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="nomor">Nomor</label>
                                <input type="text" class="form-control" id="nomor" name="nomor" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="customer">Customer</label>
                                <br>
                                <select class="select2 form-control" style="width: 100%" id="customer" name="customer_id" required>
                                    {{-- <option value="1">PT. A</option>
                                    <option value="2">PT. B</option> --}}
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="awal">Awal Kontrak</label>
                                <input type="date" class="form-control" id="awal" name="awal" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="akhir">Akhir Kontrak</label>
                                <input type="date" class="form-control" id="akhir" name="akhir" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="reminder">Reminder</label>
                                <input type="date" class="form-control" id="reminder" name="reminder" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="pdf">Upload Dokumen Kontrak -FILE HARUS PDF</label>
                                <input class="form-control" type="file" id="pdf" name="pdf" accept="application/pdf" multiple required>
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
    var url_datatable = "{{ route('kontrak') }}"; //Index url
    var url_store = "{{route('kontrak.store')}}"; //Store/add url
    var url_get = "{{ route('kontrak.get', ':id') }}"; //Get one obj url 
    var url_update = "{{ route('kontrak.update', ':id') }}"; //Update url 
    var url_delete = "{{ route('kontrak.delete', ':id') }}"; //Delete url
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
                {data: 'customer', name: 'customer'},
                {data: 'awal', name: 'awal'},
                {data: 'akhir', name: 'akhir'},
                {data: 'reminder', name: 'reminder'},
                {data: 'pdf', name: 'pdf'},
                {data: 'action', name: 'action'}
            ]
        });
    })
    
    //show form
    function open_form(id) {
        $('.select2').select2({
            placeholder: "Pilih Customer",
            ajax: { 
            url: "{{route('customer.select')}}",
            type: "GET",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        search: params.term // search term
                    };
                },
                processResults: function (res) {
                    return {
                    results: res
                    };
                },
                cache: true
            }
        }); 
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
                        form_element.find('input[type="date"][name='+key+']').val(value);
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
                    if (errors.errors.pdf != null) {
                        message = 'Dokumen kontrak tidak sesuai';
                    }else{
                        message = 'Gagal menambahkan data';
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
                    if (errors.errors.pdf != null) {
                        message = 'Dokumen kontrak tidak sesuai';
                    }else{
                        message = 'Gagal mengubah data';
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

    function openPdf(id) {
        $('#modal_pdf').modal('show');
        url = $('#link_pdf'+id).attr('href');
        $('#modal_pdf iframe').attr('src', url);
    }

</script>
@endsection