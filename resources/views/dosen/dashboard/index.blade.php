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
                    <div class="col-12">
                        <div class="form-group">
                            <div class="controls">
                                <select name="mhs_id" id="mhs_id" class="select2 form-control" style="width: 100%" required
                                    data-validation-required-message="Tidak Boleh Kosong">
                                    <option value="">Pilih Mahasiswa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="co-12">
                        <div id="grafikMhs"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mhs yang telah melakukan perwalian --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Daftar Mahasiswa yang telah melakukan perwalian</h4>
                    <p class="card-title-desc">Daftar Mahasiswa dibagi per Program Studi</p>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        @foreach ($prodi as $item)
                        <li class="nav-item">
                            <a class="nav-link @if ($item->id==1) active @endif" data-toggle="tab" href="#menu{{ $item->id }}" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">{{ $item->nm_prodi }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        @foreach ($prodi as $item)
                         <div class="tab-pane @if ($item->id==1) active @endif" id="menu{{ $item->id }}" role="tabpanel">
                            <table class="tableKu table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Dosen Wali</th>
                                        <th>Tgl. Perwalian</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($krs as $itemKrs)
                                        @if ($item->id==$itemKrs->perwalian->mhs->prodi_id)
                                        <tr>
                                            <td>{{ $itemKrs->perwalian->mhs->NPM }}</td>
                                            <td>{{ $itemKrs->perwalian->mhs->nm_mhs }}</td>
                                            <td>{{ $itemKrs->perwalian->dosen->nm_dosen }}</td>
                                            <td>{{ $itemKrs->tgl_krs }}</td>
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
    <!-- end row -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.tableKu').DataTable({
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ]
            });
        });
    </script>
    <!-- apexcharts -->
    <script src="{{ asset('assetsAdmin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('assetsAdmin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assetsAdmin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assetsAdmin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    {{-- Grafik --}}
    <script>
        // Grafik Gereja
        let ipk = []
        let thnSmeter = []

        function loadDataMhs() {
            $.ajax({
                url: '/dosen/grafikMhs',
                type: "GET",
                datatype: "JSON",
                success: function(data) {
                    $.each(data.dataMhs, function(index, value) {
                        $("#mhs_id").append('<option value="' + value.id + '">' + value.nm_mhs +
                            '</option>');
                    });
                }
            })
        }

        loadDataMhs()

        $('#mhs_id').on('change', function() {
            $('#grafikMhs').empty()
            mhs_id = $(this).val()
            loadDataGrafik(mhs_id)
        })

        function loadDataGrafik(mhs_id) {
            $.ajax({
                    url: '/dosen/grafikMhs',
                    type: "GET",
                    datatype: "JSON",
                    data: {
                        'mhs_id': mhs_id,
                    },
                    success: function(data) {
                        $.each(data.dataGrafikMhs, function(index, value) {
                            thnSmeter.push(value.tahun_ak + '-' + value.semester_ak)
                            ipk.push(value.angka)
                        });
                        grafikMhs()
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Server tidak merespon...');
                });
        }


        function grafikMhs() {
            var options = {
                series: [{
                    name: 'IPK',
                    data: ipk
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
                    categories: thnSmeter,
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

    </script>



@endsection
