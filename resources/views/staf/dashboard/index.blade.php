@extends('staf.layouts.default')

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
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-4">Selamat Datang {{ auth()->user()->tools->nm_tool }}</h4>
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
