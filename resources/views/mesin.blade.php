@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Mesin</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-mesin">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Mesin
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Mesin
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table id="mesin_table" class="table table-bordered table-striped table-vcenter w-100">
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

        <div class="block block-rounded" id="add-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Register Mesin</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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



        {{-- edit modal --}}
        <div class="block block-rounded" id="edit-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Mesin</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide-edit"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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
                                <button type="button" class="btn btn-alt-danger" id="clear-form-edit"><i class="si si-close"></i> Clear</button>
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

    var save_id;

    $(document).ready(function () {
        $('#mesin_table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('mesin') }}",
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
    });


    $('#btn-add').on('click', function() {
        $('#add-form').show(500);
        $('#list-mesin').hide();
    });

    $('#add-form form').on('submit', function (event) { 
        event.preventDefault();
        $.ajax({
            type:'POST',
            url : "{{route('mesin.add')}}",
            data : $(this).serializeArray(),
            success : function (res) {
                var table = $('#mesin_table').DataTable();
                table.draw();
                Swal.fire(
                    'Created!',
                    'Data berhasil di tambahkan.',
                    'success'
                )
            },
            error : function (res) {  
                var errors = res.responseJSON;
                if (errors.errors.nomor != null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Nomor Mesin sudah terdaftar di mesin lain',
                    })
                }else if (errors.errors.serial != null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Serial Number sudah terdaftar di mesin lain',
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Nomor Mesin dan Serial Number sudah terdaftar di mesin lain',
                    })
                }
            }
        });
    })

    $('#btn-hide').on('click', function() {
        $('#list-mesin').show(500);
        $('#add-form').hide();
    });

    $('#btn-hide-edit').on('click', function() {
        $('#list-mesin').show(500);
        $('#edit-form').hide();
    });

    $('#clear-form-edit').on('click', function(){
        edit_data(save_id);
    });
    function edit_data(id) {
        save_id = id;
        var url = "{{ route('mesin.get', ':id') }}";
        url = url.replace(':id', id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type:'GET',
            url : url,
            success : function(res) {
                $('#edit-form #nomor').val(res.data.nomor);
                $('#edit-form #serial').val(res.data.serial);
                $('#edit-form #model').val(res.data.model);
                $('#edit-form #tegangan').val(res.data.tegangan);
                $('#edit-form #meter').val(res.data.meter);
                $('#edit-form #meter').val(res.data.meter);
                $('#edit-form #asal').children('option').removeAttr('selected');
                $('#edit-form #asal').children('option[value='+res.data.asal+']').attr('selected','selected');
                $('#edit-form #status').children('option').removeAttr('selected');
                $('#edit-form #status').children('option[value='+res.data.status+']').attr('selected', 'selected');
            }
        });
        $('#edit-form').show(500);
        $('#list-mesin').hide();
    }

    $('#edit-form form').on('submit', function (event) {
        event.preventDefault();
        var url = "{{route('mesin.update', ':id')}}",
        url = url.replace(':id', save_id);
        $.ajax({
            type:'PUT',
            url : url,
            data : $(this).serializeArray(),
            success : function (res) {
                var table = $('#mesin_table').DataTable();
                table.draw();
                Swal.fire(
                    'Updated!',
                    'Data berhasil di update.',
                    'success'
                )
            },
            error : function (res) {  
                var errors = res.responseJSON;
                if (errors.errors.nomor != null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Nomor Mesin sudah terdaftar di mesin lain',
                    })
                }else if (errors.errors.serial != null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Serial Number sudah terdaftar di mesin lain',
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: 'Nomor Mesin dan Serial Number sudah terdaftar di mesin lain',
                    })
                }
            }
        });
    })

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
                var url = "{{ route('mesin.delete', ':id') }}";
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
                        table = $('#mesin_table').DataTable();
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