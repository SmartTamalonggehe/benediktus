@php
    use Carbon\Carbon;
@endphp
@extends('mhs.layouts.default')

@section('judul', 'Perwalian')

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assetsAdmin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assetsAdmin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assetsAdmin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

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
        {{-- Jika KHS belum Selesai --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-auto mr-auto ml-auto">
                            <tr>
                                <td><h4 class="card-title">Dosen Wali</h4></td>
                                <td><h4 class="card-title mr-5 ml-2">: {{ auth()->user()->mhs->perwalian->dosen->nm_dosen }}</h4></td>
                                <td><h4 class="card-title ml-5"> Nama Mahasiswa</h4></td>
                                <td><h4 class="card-title">: {{ auth()->user()->mhs->nm_mhs }}</h4></td>
                            </tr>
                            <tr>
                                <td><h4 class="card-title">IPK</h4></td>
                                <td><h4 class="card-title ml-2">: {{ $khs->IPK }}</h4></td>
                                <td><h4 class="card-title ml-5">NPM</h4></td>
                                <td><h4 class="card-title">: {{ auth()->user()->mhs->NPM }}</h4></td>
                            </tr>
                            <tr>
                                <td><h4 class="card-title">Beban</h4></td>
                                <td><h4 class="card-title ml-2">: {{ $beban }} SKS</h4></td>
                                <td><h4 class="card-title ml-5">Program Studi</h4></td>
                                <td><h4 class="card-title">: {{ auth()->user()->mhs->prodi->nm_prodi }}</h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Jadwal --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Jadwal Perkulihan</h4>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary float-right">Download Jadwal</button>
                        </div>
                    </div>
                    <p class="card-title-desc">Silahkan memilih matakuliah yang akan dikontrak. Total sks matakuliah yang dikontrak tidak boleh lebih dari beban SKS {{ $beban }}</p>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach ($semester as $itemSemester)
                        <li class="nav-item tabJadwal">
                            <a class="nav-link ambilSemester" data-id="{{ $itemSemester->matkul->semester }}" data-toggle="tab" href="#semester{{ $itemSemester->matkul->semester }}" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Semester {{ $itemSemester->matkul->semester }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        @foreach ($semester as $itemSemester)
                        <div class="tab-pane" id="semester{{ $itemSemester->matkul->semester }}" role="tabpanel">

                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kode MK</th>
                                        <th>SKS</th>
                                        <th>Progdi-SMT</th>
                                        <th>Ruang</th>
                                        <th>Dosen</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($jadwal as $item)
                                    @if ($item->matkul->semester==$itemSemester->matkul->semester)
                                    <tr class="clickable-row" data-id='{{ $item->id }}'>
                                        <td>{{ $item->hari }}</td>
                                        <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
                                        <td>{{ $item->matkul->nm_matkul }}</td>
                                        <td>{{ $item->matkul->kd_matkul }}</td>
                                        <td>{{ $item->matkul->sks }}</td>
                                        <td>{{ $item->prodi->kd_prodi }}-{{ $item->matkul->semester }}</td>
                                        <td>{{ $item->ruang->kd_ruang }}</td>
                                        <td>{{ $item->dosen->nm_dosen }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>

    @include('mhs.perwalian.form')

    <div class="modal fade text-left" id="alertPertanyaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Pilih Tindakan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Silahkan Pilih tindakan selanjutnya.</p>

                </div>
                <div class="text-center mb-2">
                    <button type="button" class="btn btn-warning" id="btnUbah"><i class="feather icon-edit"></i> Ubah</button>
                    <button type="button" class="btn btn-danger" id="btnHapus"><i class="feather icon-trash-2"></i> Hapus</button>
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

     {{-- Tap Jadwal --}}
     <script>
        $(document).ready(function () {
            $('.tabJadwal a:first').addClass('active');
            $('.tab-content.p-3.text-muted div:first').addClass('active');
        });
     </script>



    {{-- <script>
        // Load Data
        function loadMoreData() {
            $.ajax({
                url: '',
                type: "get",
                datatype: "html",
                success:function(data){
                    $('#tampil').html(data);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Server tidak merespon...');
            });
        }
        loadMoreData();
    </script> --}}

    {{-- Tambah dan Ubah Data --}}
    {{-- <script>
        $('#tambah').click(function(){
            save_method="add"
            $('#judul').html('From Tambah Data')
            $('#tombolForm').html('Simpan Data')
            $('.tampilModal').modal('show')
            $('#formKu').trigger('reset');
            $('.select2').val('').trigger('change');
        });

        $(document).ready(function () {
            $("#formKu").on('submit',function(e){
            e.preventDefault();
            let id = $('#id').val();
            let dataKu = $('#formKu').serialize();
            if (save_method=="add") {
                url="{{ route('dosen.store') }}"
                method="POST"
            } else {
                url="dosen/" + id
                method="PUT"
            }
            $.ajax({
            url: url,
            type: method,
            data: dataKu,
            success: function(response) {
                    if (save_method=="add") {
                        toastr.info('Data Disimpan ', 'Berhasil', { "progressBar": true });
                    } else {
                        toastr.info('Data Diubah ', 'Berhasil', { "progressBar": true });
                        aksi=$('.tampilModal').modal('hide')
                    }
                    $('#formKu').trigger('reset');
                    $('.select2').val('').trigger('change');
                loadMoreData();
                //   pesan
            }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('Error.');
                });
            console.log(save_method)
            });
        });

    </script> --}}

@endsection
