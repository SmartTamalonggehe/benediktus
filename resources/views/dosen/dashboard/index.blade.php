@extends('dosen.layouts.default')

@section('judul', 'Dashboard')

@section('css')
    <!-- jquery.vectormap css -->
    <link href="{{ asset('assetsAdmin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">@yield('judul')</h4>

                {{-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div> --}}

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
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
                    <h4 class="mt-4">Selamat Datang {{ auth()->user()->dosen->nm_dosen }}</h4>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="grafikMhs"></div>
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
    <script src="{{ asset('assetsAdmin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    <script src="{{ asset('assetsAdmin/js/pages/dashboard.init.js') }}"></script>

    {{-- Grafik --}}
    <script>
        // Grafik Gereja
        let nm_gereja = []
        let total_wijk = []

        function loadDataGrafik() {
            $.ajax({
                    url: '/api/grafikGereja',
                    type: "GET",
                    datatype: "JSON",
                    success: function(data) {
                        $.each(data, function(index, value) {
                            nm_gereja.push(value.nm_gereja)
                            total_wijk.push(value.total_wijk)
                        });
                        grafikGereja()
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Server tidak merespon...');
                });
        }

        // loadDataGrafik()


        function grafikGereja() {
            var options = {
                series: [{
                    name: 'Total Jemaat',
                    data: [12,6]
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: ['ahf','yu6'],
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                theme: {
                    palette: 'palette8' // upto palette10
                }
            };

            var chart = new ApexCharts(document.querySelector("#grafikMhs"), options);

            chart.render();
        }

        grafikGereja()

    </script>



@endsection
