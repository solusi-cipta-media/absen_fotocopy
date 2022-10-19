@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Overhaul</h2>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded" id="list-karyawan">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Riwayat Aktivitas Mesin
                </h3>
                <!-- <button type="button" class="btn btn-outline-primary min-width-125" id="btn-add">
                    <i class="fa fa-plus mr-5"></i> Register Customer
                </button> -->
            </div>
            <div class="block-content block-content-full">
                <div class="row push">
                    <div class="col-lg-12 col-xl-12">
                        <div class="mb-4">
                            <label class="form-label" for="qrcode">Scan <strong>QR CODE</strong> atau input <strong>SERIAL NUMBER</strong> mesin</label>
                            <input type="text" class="form-control" id="qrcode" name="qrcode" autofocus>
                        </div>
                    </div>
                </div>
                <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> -->
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Serial Number</th>
                            <th>Aktivitas</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">663451</td>
                            <td><span class="badge bg-success">Overhaul</span></td>
                            <td>22-Oct-2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection