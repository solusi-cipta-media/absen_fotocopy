@extends('template.app')
@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <h2 class="content-heading">Riwayat Pengajuan Cuti</h2>
            <div class=" d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#modal">+ Buat
                    pengajuan</button>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal-fadein" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Pengajuan Cuti</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="tanggal" class="col-form-label col-xl-2 col-md-6">Tanggal</label>
                                        <div class="col-md-6 col-xl-10">
                                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                required min="{{ now()->toDateString('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cuti" class="col-form-label col-xl-2 col-md-6">Jenis Cuti</label>
                                        <div class="col-md-6 col-xl-10">
                                            <select name="cuti" id="cuti" class="form-select" required>
                                                <option value="0">Izin/Sakit</option>
                                                @foreach ($cutis as $cuti)
                                                    <option value="{{ $cuti->id }}">{{ $cuti->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="bukti">
                                        <label for="bukti" class="col-form-label col-xl-2 col-md-6">Bukti Foto</label>
                                        <div class="col-md-6 col-xl-10">
                                            <input type="file" name="bukti" id="bukti" class="form-control"
                                                accept="image/png, image/jpeg" multiple>
                                        </div>
                                    </div>
                            </div>
                            <div class="block-content block-content-full block-content-sm text-end border-top">
                                <div class="row items-push text-center">
                                    <div class="col mb-1">
                                        <button type="submit" class="btn btn-success">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="modal-fadein" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Detail Pengajuan Cuti</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm">
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-form-label col-xl-2 col-md-6">Tanggal</label>
                                    <div class="col-md-6 col-xl-10">
                                        <input type="text" name="tanggal" id="tanggal" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="cuti" class="col-form-label col-xl-2 col-md-6">Jenis Cuti</label>
                                    <div class="col-md-6 col-xl-10">
                                        <input type="text" name="cuti" id="cuti" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="status" class="col-form-label col-xl-2 col-md-6">Status</label>
                                    <div class="col-md-6 col-xl-10">
                                        <input type="text" name="status" id="status" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3" id="bukti">
                                    <label for="bukti" class="col-form-label col-xl-2 col-md-6">Bukti Foto</label>
                                    <div class="col-md-6 col-xl-10">
                                        <img src="" class="img-fluid" alt="bukti_pengajuan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-12 list">
                @foreach ($data as $item)
                    <a class="block block-rounded block-link-shadow text-center mb-4" href="javascript:void(0)">
                        <div class="block-content block-content-full block-content-sm bg-body-light position-relative">
                            <div class="row">
                                <div class="col-9 text-start">
                                    <span
                                        class="fs-5 fw-bold">{{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $item->periode->tanggal)->format('d F Y') }}
                                    </span><br>
                                    @if (isset($item->cuti_id))
                                        {{ $item->cuti->nama }}
                                    @else
                                        Izin/Sakit
                                    @endif
                                </div>
                                <div class="col-3 position-relative">
                                    <div class="position-absolute bottom-0 end-0">
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="open_bukti('{{ $item->id }}','{{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $item->periode->tanggal)->format('d F Y') }}', '{{ isset($item->cuti_id) ? $item->cuti->nama : 'Izin/Sakit' }}', '{{ ucfirst($item->status) }}', '{{ isset($item->bukti) ? $item->bukti : '' }}')">
                                            <i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute top-0 end-0">
                                @if ($item->status === 'approved')
                                    <span class="badge bg-success w-100 d-flex text-end">Approved</span>
                                @elseif ($item->status === 'rejected')
                                    <span class="badge bg-danger w-100 d-flex text-end">Rejected</span>
                                @else
                                    <span class="badge bg-warning w-100 d-flex text-end">Waiting</span>
                                @endif
                            </div>
                            <div class="position-absolute top-0 start-0 translate-middle-y">
                                <span
                                    class="badge bg-dark">{{ Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F Y') }}</span>
                            </div>
                        </div>
                    </a>
                    @if (isset($item->bukti))
                        <a href="{{ $item->bukti }}" id="link_bukti{{ $item->id }}" style="display: none"></a>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
    <script>
        $("select[name='cuti']").on('change', function() {
            if ($(this).val() === '0') {
                $("div[id='bukti']").show();
            } else {
                $("div[id='bukti']").hide();
                $("input[type='file']").val('');
            }
        });

        $("button[type='reset']").on('click', function() {
            $("div[id='bukti']").show();
            $("input[type='file']").val('');
        });

        $('form').on('submit', function(event) {
            event.preventDefault();
            var form = $(this)[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            });
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "{{ route('pengajuancuti.store') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {
                    $('.list').prepend(`
                        <a class="block block-rounded block-link-shadow text-center mb-4" href="javascript:void(0)">
                            <div class="block-content block-content-full block-content-sm bg-body-light position-relative">
                                <div class="row">
                                    <div class="col-9 text-start">
                                        <span class="fs-5 fw-bold mt-3">` + res.data.tanggal + `
                                        </span><br>
                                        ` + res.data.cuti + `
                                    </div>
                                    <div class="col-3 position-relative">
                                        <div class="position-absolute bottom-0 end-0">
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="open_bukti('` + res.data.id + `','` + res.data.tanggal +
                        `', '` + res.data.cuti + `', '` + res.data.status + `','` + res.data.bukti + `')">
                                                <i class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-warning w-100 d-flex text-end">Waiting</span>
                                </div>
                                <div class="position-absolute top-0 start-0 translate-middle-y">
                                    <span class="badge bg-dark">` + res.data.tanggal_pengajuan + `</span>
                                </div>
                            </div>
                        </a>
                        <a href="` + res.data.bukti + `" id="link_bukti` + res.data.id + `" style="display: none"></a>
                    `);
                    Swal.fire(
                        'Created!',
                        'Berhasil membuat pengajuan cuti.',
                        'success'
                    )
                },
                error: function(res) {
                    var message = res.responseJSON.message;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warnings',
                        text: message,
                    });
                }
            });
        });

        function open_bukti(id, tanggal, cuti, status, bukti) {
            console.log(bukti);
            $('#modal_detail').modal('show');
            $('#modal_detail input[name="tanggal"]').val(tanggal);
            $('#modal_detail input[name="cuti"]').val(cuti);
            $('#modal_detail input[name="status"]').val(status);
            if (bukti != '') {
                url = $('#link_bukti' + id).attr('href');
                $('#modal_detail img').show();
                $('#modal_detail label[for="bukti"]').show();
                $('#modal_detail img').attr('src', url);
            } else {
                $('#link_bukti' + id).removeAttr('href');
                $('#modal_detail img').hide();
                $('#modal_detail label[for="bukti"]').hide();
            }
        }
    </script>
@endsection
