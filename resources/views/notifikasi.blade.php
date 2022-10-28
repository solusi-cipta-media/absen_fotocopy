@extends('template.app')

@section('content')
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <h2 class="content-heading d-flex justify-content-between align-items-center">
      <span>Notifikasi</span>
    </h2>

    <!-- Messages -->
    <!-- Checkable Table (.js-table-checkable class is initialized in Helpers.cbTableToolsCheckable()) -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          Notifikasi
        </h3>
      </div>
      <div class="block-content block-content-full">
        <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Pesan</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            {{-- <tr>
              <td class="text-center">1</td>
              <td class="fw-semibold">Kontrak dengan PT ABnjasdiawi akan berakhir tanggal 15 agustus 2023</td>
              <td class="fw-semibold">2 days ago</td>              
            </tr> --}}
          </tbody>
        </table>
      </div>
    </div>
        <!-- END Dynamic Table Full -->
  </div>
</main>
<script>
  $(document).ready(function () {
        $('table').DataTable({
            serverSide: true,
            responsive: true,
            ajax: "{{ route('notifikasi') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'pesan', name: 'pesan'},
                {data: 'waktu', name: 'waktu'},
            ]
        });
    })
</script>
@endsection
