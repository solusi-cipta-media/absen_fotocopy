@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Absensi</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Periode Kerja - Working Calendar
                </h3>
                <button type="button" class="btn btn-outline-primary min-width-125" onclick="open_form()">
                    <i class="fa fa-plus mr-5"></i> Register Periode
                </button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter w-100">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tanggal</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Status Hari</th>
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
                <h3 class="block-title">Register Periode</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-outline-danger min-width-125" onclick="close_form()"><i class="fa fa-minus-circle"></i> Sembunyikan</button>
                </div>
            </div>
            <div class="block-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row push">
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <label class="form-label" for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="status">Status Hari Kerja</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="libur">Libur</option>
                                </select>
                            </div>
                            <div class="row clock">
                                <div class="col-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="clock_in">Clock In</label>
                                        <input type="text" class="form-control" id="clock_in" name="clock_in" value="08:00" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="clock_out">Clock Out</label>
                                        <input type="text" class="form-control" id="clock_out" name="clock_out" value="16:00" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary"><i class="si si-cloud-upload"></i> Simpan</button>
                                <button type="reset" class="btn btn-alt-danger"><i class="si si-close"></i> Clear</button>
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
    var url_datatable = "{{ route('periode') }}"; //Index url
    var url_store = "{{route('periode.store')}}"; //Store/add url
    var url_delete = "{{ route('periode.delete', ':id') }}"; //Delete url
    var ajax_header = {
            "X-CSRF-TOKEN" : "{{ csrf_token() }}"
        }; //Token
    // local variable
    var datatable_element = list_element.find('table'); //Init datatable variable

    $(document).ready(function () {
        datatable_element.DataTable({
            serverSide: true,
            responsive: true,
            ajax: url_datatable,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'clock_in', name: 'clock_in'},
                {data: 'clock_out', name: 'clock_out'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
            ]
        });

        
    });

    function open_form() {
        form_element.find('input[type="date"]').val('');
        $('#clock_in').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            defaultDate: "08:00",
            time_24hr: true,
        });
        $('#clock_out').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            defaultDate: "16:00",
            time_24hr: true,
        });
        form_element.show(500);
        list_element.hide();
    }

    $('#status').on('change', function () {
        if ($(this).val()=='aktif') {
            console.log($(this).val());
            $('.clock').show();
        }else{
            $('.clock').hide();
        }
    })

    function close_form() { 
        form_element.find('input').val('');
        list_element.show(500);
        form_element.hide();
    }

    form_element.find('form').on('submit', function (event) { 
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
                    text: 'Tanggal periode sudah terdaftar',
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

</script>
@endsection