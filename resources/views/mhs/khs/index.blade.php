@extends('mhs.layouts.default')

@section('judul', 'Kartu Hasil Studi')

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
        {{-- Jika KHS belum Ada --}}
        <div class="col-12" id="khsTidakAda" style="display: none">
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">Silahkan Mengupload KHS anda.
                    </p>
                    <form id="cobaUpload" method="post" action="{{ route('mhsKhs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <div class="col-md-8">
                                <input type="file" name="gambar_khs" accept="image/*" id="gambar_khs" />
                              </div>
                              <div class="col-md-4">
                                  <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                              </div>
                          </div>
                      </form>
                      <br />
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                          0%
                        </div>
                      </div>
                      <br />
                      <div id="success">

                      </div>
                      <br />
                </div>
            </div>
        </div>
        {{-- Jika Status Menunggu --}}
        <div class="col-12" id="khsMenunggu" style="display: none">
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">Terima Kasih telah mengupload KHS anda. Mohon menunggu persetujuan dari staf untuk melanjutkan ke perwalian.
                    </p>
                    <div class="tampil"></div>
                </div>
            </div>
        </div>
        {{-- Jika Status Berhasil --}}
        <div class="col-12" id="khsBerhasil" style="display: none">
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">Silahkan melanjutkan ke <a href="{{ route('mhsPerwalian.index') }}">Perwalian</a>.
                    </p>
                    <div class="tampil"></div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    @include('mhs.khs.form')
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

     <script src="http://malsup.github.com/jquery.form.js"></script>



     {{-- Upload --}}
     <script>
       $(document).ready(function(){
           $('#cobaUpload').ajaxForm({
               beforeSend:function(){
                   $('#success').empty();
               },
               uploadProgress:function(event, position, total, percentComplete)
               {
                   $('.progress-bar').text(percentComplete + '%');
                   $('.progress-bar').css('width', percentComplete + '%');
               },
               success:function(data)
               {
                   if(data.errors)
                   {
                        $('.progress-bar').text('0%');
                        $('.progress-bar').css('width', '0%');
                        $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                   }
                   if(data.success)
                   {
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                        $('#success').append(data.image);
                        location.reload();
                   }
               }
           });
       });
     </script>

    <script>
        // Load Data
        function loadDataKhs() {
            $.ajax({
                url: '',
                type: "get",
                datatype: "html",
                success:function(data){
                    $('.tampil').html(data);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Server tidak merespon...');
            });
        }
    </script>

    {{-- Tambah dan Ubah Data --}}
    <script>
        $(document).ready(function () {
            $("#formKu").on('submit',function(e){
            e.preventDefault();
            let id = $('#id').val();
            let data = new FormData(this);
            data.append('_method', 'PUT');
            let csrf_token=$('meta[name="csrf_token"]').attr('content')
            $.ajax({
                url: "mhsKhs/" + id,
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                   if(data.success)
                   {
                        aksi=$('.tampilModal').modal('hide')
                        loadDataKhs();
                   }
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
