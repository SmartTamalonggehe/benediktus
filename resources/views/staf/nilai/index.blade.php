@extends('staf.layouts.default')

@section('judul', 'Nilai Mahasiswa')

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
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data @yield('judul')</h4>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <select name="tahun_ak" id="tahun_ak" class="select2 form-control">
                                <option value="">Pilih Tahun</option>
                                @foreach ($tahun->keyBy('krs.tahun_ak') as $item)
                                    <option value="{{ $item->krs->tahun_ak }}">{{ $item->krs->tahun_ak }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select name="semester_ak" id="semester_ak" class="select2 form-control">
                                <option value="">Pilih Semester</option>
                                <option value="GANJIL">Ganjil</option>
                                <option value="GENAP">Genap</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <div id="tampil"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    @include('staf.nilai.form')

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
            let semester_ak=$('#semester_ak').val();
            let tahun_ak=$('#tahun_ak').val();
            $.ajax({
                url: '',
                type: "get",
                datatype: "JSON",
                data:{
                        'semester_ak':semester_ak,
                        'tahun_ak':tahun_ak,
                    },
                success:function(data){
                    $('#tampil').html(data);
                    console.log(semester_ak);
                    console.log(tahun_ak);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Server tidak merespon...');
            });
        }
        loadMoreData();
        // Pilih Semester & Tahun
        $('#semester_ak').on('change', function(){
            loadMoreData()
        })
        $('#tahun_ak').on('change', function(){
            loadMoreData()
        })
    </script>

    {{-- Tambah dan Ubah Data --}}
    <script>
        $(document).ready(function () {
            $("#formKu").on('submit',function(e){
            e.preventDefault();
            let id = $('.id').val();
            let dataKu = $('#formKu').serialize();
            if (save_method=="add") {
                url="{{ route('nilai.store') }}"
                method="POST"
            } else {
                url = '{{ route("nilai.update", ":id") }}';
                url = url.replace(':id', id);
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
                    }
                aksi=$('.tampilModal').modal('hide')
                $('#id').val('');
                loadMoreData();
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
