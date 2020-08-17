@extends('staf.layouts.default')

@section('judul', 'KHS / Nilai')

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assetsAdmin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assetsAdmin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive Table css -->
    <link href="{{ asset('assetsAdmin/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Lightbox css -->
    <link href="{{ asset('assetsAdmin/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

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
                    <p class="card-title-desc">Klik 2x untuk menghapus atau mengubah data.
                    </p>

                    {{-- <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                                <div class="form-group">
                                    <select name="semester_ak" class="select2 form-control semester_ak">
                                        <option value="GANJIL">GANJIL</option>
                                        <option value="GENAP">GENAP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                                <div class="form-group">
                                    <select name="tahun" class="select2 form-control tahun_ak">
                                        @foreach ($param->keyBy('tahun_ak') as $item)
                                        <option value="{{ $item->tahun_ak }}">{{ $item->tahun_ak }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div id="tampil"></div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    @include('staf.khs.form')

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



    {{-- Menentukan Tahun dan Semester --}}
    <script>
        $(document).ready(function(){
            let sekarang = new Date();
            let tahun = sekarang.getFullYear();
            for (let i = tahun; i > tahun - 3; i--) {
                $('#tahun_ak').append('<option value="' + i + '">' + i + '</option>');
            }
            let bulan = sekarang.getMonth();
            let semester_ak;
            bulan > 6 ? semester_ak="GANJIL" : semester_ak="GENAP";
            $('.semester_ak').val(semester_ak).trigger('change')
            $('.tahun_ak').val(tahun).trigger('change');
        });
    </script>

    <script>
        //    Parameter Jadwal
        $(document).ready(function(){
            $('.semester_ak').on('change', function(){
                loadMoreData();
            })
        });
        $(document).ready(function(){
            $('.tahun_ak').on('change', function(){
                loadMoreData();
            })
        });

        // Load Modal
        $(document).ready(function(){
            $(".modal-content").addClass("animated " + "flipInY");
        });
        // Load Data
        function loadMoreData() {
            $(document).ready(function(){
                let semester_ak=$('.semester_ak').val();
                let tahun_ak=$('.tahun_ak').val();
                $.ajax({
                    url: '',
                    type: "get",
                    datatype: "html",
                    data:{
                        'semester_ak':semester_ak,
                        'tahun_ak':tahun_ak,
                    },
                    success:function(data){
                        $('#tampil').html(data);
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('Server tidak merespon...');
                });
            })
        }
        loadMoreData();
    </script>

    {{-- Tambah dan Ubah Data --}}
    <script>
    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
            e.preventDefault();
            let id = $('#id').val();
            let dataKu = $('#formKu').serialize();
            if (save_method=="add") {
                url="{{ route('khs.store') }}"
                method="POST"
            } else {
                url= "khs/"+id
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
                $('#formKu').trigger("reset");
                aksi=$('.tampilModal').modal('hide')
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

    </script>


@endsection
