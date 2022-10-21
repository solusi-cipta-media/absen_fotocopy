@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Kontrak</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-kontrak">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Kontrak
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Kontrak
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table id="kontrak_table" class="table table-bordered table-striped table-vcenter w-100">
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Dokumen Kontrak</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="" frameborder="0" class="w-100" style="height: 400px"></iframe>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>

        <div class="block block-rounded" id="add-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Register Kontrak</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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


        <div class="block block-rounded" id="edit-form" style="display: none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Kontrak</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide-edit"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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
                                <select class="select2edit form-control" style="width: 100%" id="customer" name="customer_id" required>
                                    <option value="" selected="selected"></option>
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
                                <input class="form-control" type="file" id="pdf" name="pdf" accept="application/pdf" multiple>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="button" onclick="edit_data(save_id)" class="btn btn-alt-danger" id="clear-form"><i class="si si-close"></i> Clear</button>
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
        $('#kontrak_table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('kontrak') }}",
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


    });
    $('#btn-add').on('click', function() {
        $('.select2').select2({
            placeholder: "Pilih Customer",
            allowClear: true,
            ajax: { 
            url: "{{route('customer.select')}}",
            type: "post",
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
        $('#add-form').show(500);
        $('#list-kontrak').hide();
    });

    $('#btn-hide').on('click', function() {
        $('#list-kontrak').show(500);
        $('#add-form').hide();
    });

    $('#btn-hide-edit').on('click', function() {
        $('#list-kontrak').show(500);
        $('#edit-form').hide();
    });


    function openPdf(id) {
        $('#modal_pdf').modal('show');
        url = $('#link_pdf'+id).attr('href');
        $('#modal_pdf iframe').attr('src', url);
    }

    var save_id;
    function edit_data(id) {
        $('.select2edit').select2({
            placeholder: "Pilih Customer",
            allowClear: true,
            ajax: { 
            url: "{{route('customer.select')}}",
            type: "post",
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
        save_id = id;
        var url = "{{ route('kontrak.get',':id') }}";
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
                $('#edit-form #nomor').val(res.data.nomor);
                $('#edit-form #awal').val(res.data.awal);
                $('#edit-form #akhir').val(res.data.akhir);
                $('#edit-form #reminder').val(res.data.reminder);
                // $("#edit-form li[data-select-2]").text("New Text");
                // $('#edit-form option:selected"').attr('value',res.data.customer_id);
            }
        });
        $('#edit-form').show(500);
        $('#list-kontrak').hide();
    }

    $('#edit-form form').on('submit', function (event) {
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        var url = "{{ route('kontrak.update', ':id') }}";
        url = url.replace(':id',save_id);

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
                table = $('#kontrak_table').DataTable();
                table.draw();
                Swal.fire(
                    'Created!',
                    'Data berhasil diupdate.',
                    'success'
                )
            },
            error : function (res) {
                var errors = res.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Gagal mengupdate data',
                });
            }
        });
    });

    // Add data
    $('#add-form form').on('submit', function (event) {
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        var url = "{{ route('kontrak.store') }}";
    
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
                $('#add-form option').removeAttr('selected');
                table = $('#kontrak_table').DataTable();
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
                var url = "{{ route('kontrak.delete', ':id') }}";
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
                        table = $('#kontrak_table').DataTable();
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