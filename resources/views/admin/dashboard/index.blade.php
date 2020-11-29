@extends('admin.layouts.default')

@section('judul', 'Dashboard')

@section('css')
     <!-- jquery.vectormap css -->
     <link href="{{ asset('assetsAdmin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">@yield('judul')</h4>

                {{-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Selamat Datang Admin</li>
                    </ol>
                </div> --}}

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">New Users</div>

                        </div>
                    </div> --}}
                    <h4 class="mt-1">SELAMAT DATANG ADMIN</h4>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
@endsection

@section('js')
    <!-- apexcharts -->
    <script src="{{ asset('assetsAdmin/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('assetsAdmin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

    <script src="{{ asset('assetsAdmin/js/pages/dashboard.init.js') }}"></script>

@endsection
