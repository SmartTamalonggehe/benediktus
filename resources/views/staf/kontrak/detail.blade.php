<?php
use Carbon\Carbon;
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title mt-0">
                @foreach ($kontrak->keyBy('krs_id') as $item)
                   Detail Kontrak Matkul {{ $item->krs->perwalian->mhs->nm_mhs }}
                @endforeach
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <table class="table">
                   <tbody>
                    @foreach ($kontrak->keyBy('krs_id') as $item)
                       <tr>
                           <td>Nama</td>
                           <td>:</td>
                           <td>{{ $item->krs->perwalian->mhs->nm_mhs }}</td>
                       </tr>
                       <tr>
                           <td>Tahun - Semester</td>
                           <td>:</td>
                           <td>{{ $item->krs->tahun_ak }} - {{ $item->krs->semester_ak }}</td>
                       </tr>
                       <tr>
                           <td>Tanggal Pengisian KRS</td>
                           <td>:</td>
                           <td>{{ $item->krs->tgl_krs }}</td>
                       </tr>
                       <tr>
                           <td>Dosen Wali</td>
                           <td>:</td>
                           <td>{{ $item->krs->perwalian->dosen->nm_dosen }}</td>
                       </tr>
                    @endforeach
                   </tbody>
                </table>
            </div>
            <div class="col-12">
                <h4>Mata Kuliah Yang Dikontrak</h4>
                <table class="tableDetailKontrak table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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

                        @foreach ($kontrak as $item)
                        <tr>
                            <td>{{ $item->jadwal->hari }}</td>
                            <td>{{ Carbon::parse($item->jadwal->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jadwal->jam_seles)->format('H:i') }}</td>
                            <td>{{ $item->jadwal->matkul->nm_matkul }}</td>
                            <td>{{ $item->jadwal->matkul->kd_matkul }}</td>
                            <td>{{ $item->jadwal->matkul->sks }}</td>
                            <td>{{ $item->jadwal->prodi->kd_prodi }}-{{ $item->jadwal->matkul->semester }}</td>
                            <td>{{ $item->jadwal->ruang->kd_ruang }}</td>
                            <td>{{ $item->jadwal->dosen->nm_dosen }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" id="tombolForm" class="btn btn-primary"></button>
    </div>
</div>









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

<script>
    // Tabel Kontrak
    $(document).ready(function(){
        let tableKontrak= $('.tableDetailKontrak')
        tableKontrak.DataTable({
            "scrollX": true,
            "paging":   false,
        })
    })
</script>

