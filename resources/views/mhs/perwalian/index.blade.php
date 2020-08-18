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

    <style>
        text-small {
        font-size: 0.9rem;
        }

        .messages-box,
        .chat-box {
        height: 510px;
        overflow-y: scroll;
        }

        .rounded-lg {
        border-radius: 0.5rem;
        }

        input::placeholder {
        font-size: 0.9rem;
        color: #999;
        }

    </style>

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
                                <td><h4 class="card-title ml-2">: {{ number_format ($khs->IPK,2) }}</h4></td>
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
        <div class="col-12">
            <div id="tampil"></div>
        </div>
    </div>

    {{-- Koment --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Chat ke dosen wali</h4>
                        <div class="col-7 ml-auto mr-auto px-0">
                            <div class="px-4 py-5 chat-box bg-white overflow-auto" id="komentarPerwalian" style="height: 500px">
                            </div>
                            <!-- Typing area -->
                            <form id="kirim_komen" class="bg-light">
                                @csrf
                                <div class="input-group">
                                    <input type="text" autocomplete="off" name="pesan" id="pesan" placeholder="Ketik Pesan" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                    <div class="input-group-append">
                                    <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </form>

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


    <script>
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

        // Load Data Komentar
        function loadKomen() {
            $.ajax({
                url: '{{ route("komenPerwalian.index") }}',
                type: "get",
                datatype: "html",
                success:function(data){
                    $('#komentarPerwalian').html(data);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Server tidak merespon...');
            });
        }
        loadMoreData();
        loadKomen();
    </script>
{{-- Tambah Komentar --}}
    <script>
        $(document).ready(function () {
            $("#kirim_komen").on('submit',function(e){
            e.preventDefault();
            let id = $('#id').val();
            let dataKu = $('#kirim_komen').serialize();
            let pesan =$('#pesan').val()
            if (!pesan) {
                alert ("Tidak Bisa Mengirim Pesan Kosong")
                return 0;
            }
            $.ajax({
            url: "{{ route('komenPerwalian.store') }}",
            type: "POST",
            data: dataKu,
            success: function(response) {
                loadKomen();
                $('#pesan').val('')
                // loadKomen();
                //   pesan
            }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('Error.');
                });
            });
        });
    </script>

@endsection
