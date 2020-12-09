@php
use Carbon\Carbon;

@endphp

@extends('dosen.layouts.default')

@section('judul', 'Perwalian')

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assetsAdmin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assetsAdmin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assetsAdmin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('assetsAdmin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assetsAdmin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assetsAdmin/drluar/toas/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsAdmin/drluar/sweetalert/sweetalert2.min.css') }}">

@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">@yield('judul')</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Kontrak Matakuliah {{ $krs->perwalian->mhs->nm_mhs }}</h4>
                    <p class="card-title-desc">
                        Daftar Matakuliah yang dikontrak oleh {{ $krs->perwalian->mhs->nm_mhs }}
                    </p>

                    <table class="tableKu table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kode MK</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontrak as $itemKontrak)
                                @foreach ($jadwal as $item)
                                    @if ($item->id == $itemKontrak->jadwal_id)
                                        <tr class="clickable-row" data-id='{{ $item->id }}'>
                                            <td>{{ $item->matkul->nm_matkul }}</td>
                                            <td>{{ $item->matkul->kd_matkul }}</td>
                                            <td>{{ $item->hari }}</td>
                                            <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}
                                            </td>
                                            <td>{{ $item->ruang->kd_ruang }}</td>
                                            <td>{{ $item->matkul->sks }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                        <tr>
                            <td colspan="2">Status : {{ $krs->ket }}</td>
                            <input type="hidden" id="krs_id" value="{{ $krs->id }}">
                            <td colspan="4">
                                <form action="{{ route('perwalianDosen.update', $krs->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-3">Ubah Status:</div>
                                        <div class="col-3">
                                            <select name="ket" id="ket" class="form-control" style="width: 100%" required
                                                data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="Revisi">Revisi</option>
                                                <option value="Terima">Terima</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    {{-- Koment --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Chat ke Mahasiswa</h4>
                    <div class="col-7 ml-auto mr-auto px-0">
                        <div class="px-4 py-5 chat-box bg-white overflow-auto" id="komentarPerwalian" style="height: 500px">
                        </div>
                        <!-- Typing area -->
                        <form id="kirim_komen" class="bg-light">
                            @csrf
                            <input type="hidden" name="perwalian_id" id="perwalian_id" value="{{ $krs->perwalian_id }}">
                            <div class="input-group">
                                <input type="text" autocomplete="off" name="pesan" id="pesan" placeholder="Ketik Pesan"
                                    aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                <div class="input-group-append">
                                    <button id="button-addon2" type="submit" class="btn btn-link"> <i
                                            class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- parsley plugin -->
    <script src="{{ asset('assetsAdmin/libs/parsleyjs/parsley.min.js') }}"></script>
    <!-- validation init -->
    <script src="{{ asset('assetsAdmin/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ asset('assetsAdmin/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ asset('assetsAdmin/js/pages/form-advanced.init.js') }}"></script>

    {{-- Toas --}}
    <script src="{{ asset('assetsAdmin/drluar/toas/toastr.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/drluar/toas/toastr.js') }}"></script>
    {{-- Sweet Allert--}}
    <script src="{{ asset('assetsAdmin/drluar/sweetalert/sweetalert2.all.min.js') }}"></script>

    <script>
        // Load Data
        function loadMoreData() {
            $.ajax({
                    url: '',
                    type: "get",
                    datatype: "html",
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Server tidak merespon...');
                });
        }
        // Load Data Komentar
        function loadKomen() {
            let krs_id = $('#krs_id').val();
            $.ajax({
                    url: "{{ route('komenPerwalianDosen.index') }}",
                    type: "get",
                    datatype: "html",
                    data: {
                        krs_id: krs_id,
                    },
                    success: function(data) {
                        $('#komentarPerwalian').html(data);
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Server tidak merespon...');
                });
        }
        $(document).ready(function() {
            loadMoreData();
        })

        // Load komen perdetik
        setInterval(function() {
            loadKomen();
        }, 1000)

    </script>

    {{-- Tambah Komentar --}}
    <script>
        $(document).ready(function() {
            $("#kirim_komen").on('submit', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let dataKu = $('#kirim_komen').serialize();
                let pesan = $('#pesan').val()
                if (!pesan) {
                    alert("Tidak Bisa Mengirim Pesan Kosong")
                    return 0;
                }
                $.ajax({
                        url: "{{ route('komenPerwalianDosen.store') }}",
                        type: "POST",
                        data: dataKu,
                        success: function(response) {
                            loadKomen();
                            $('#pesan').val('')
                            // loadKomen();
                            //   pesan
                        }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('Error.');
                    });
            });
        });

    </script>

@endsection
