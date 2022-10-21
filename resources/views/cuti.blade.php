@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Cuti</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-cuti">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Master Jenis Cuti
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Jenis Cuti
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table id="cuti_table" class="table table-bordered table-striped table-vcenter w-100">
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
                        {{-- <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">Cuti Tahunan</td>
                            <td>12</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger" onclick=delete_data() data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Edit" id="btn-edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="fw-semibold">Cuti Melahirkan</td>
                            <td>90</td>
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
                <h3 class="block-title">Register Jenis Cuti</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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
                <h3 class="block-title">Edit Jenis Cuti</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" id="btn-hide-edit"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
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
        $('#cuti_table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('cuti') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'waktu', name: 'waktu'},
                {data: 'action', name: 'action'}
            ]
        });
    })

    $('#btn-add').on('click', function() {
        $('#add-form').show(500);
        $('#list-cuti').hide();
    });

    $('#btn-hide').on('click', function() {
        $('#list-cuti').show(500);
        $('#add-form').hide();
    });

    $('#btn-hide-edit').on('click', function() {
        $('#list-cuti').show(500);
        $('#edit-form').hide();
    });

    $('#add-form form').on('submit', function (event) { 
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type:'POST',
            url : "{{route('cuti.store')}}",
            data : $(this).serializeArray(),
            success : function (res) {
                $('#add-form input').val('');
                var table = $('#cuti_table').DataTable();
                table.draw();
                Swal.fire(
                    'Created!',
                    'Data berhasil di tambahkan.',
                    'success'
                )
            },
            error : function (res) {  
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Gagal menambahkan data',
                });
            }
        });
    })

    var save_id;
    function edit_data(id){
        save_id = id;
        var url = "{{ route('cuti.get', ':id') }}";
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
                $('#edit-form #nama').val(res.data.nama);
                $('#edit-form #waktu').val(res.data.waktu);
            }
        });
        $('#edit-form').show(500);
        $('#list-cuti').hide();
    }

    $('#edit-form form').on('submit', function (event) { 
        event.preventDefault();
        var url = "{{ route('cuti.update',':id') }}";
        url = url.replace(':id', save_id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type:'POST',
            url : url,
            data : $(this).serializeArray(),
            success : function (res) {
                edit_data(save_id);
                var table = $('#cuti_table').DataTable();
                table.draw();
                Swal.fire(
                    'Created!',
                    'Data berhasil di update.',
                    'success'
                )
            },
            error : function (res) {  
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Gagal mengupdate data',
                });
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
                var url = "{{ route('cuti.delete', ':id') }}";
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
                        table = $('#cuti_table').DataTable();
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