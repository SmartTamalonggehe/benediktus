<?php
use Carbon\Carbon;
?>

<table class="tableKontrak table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>

        <tr>
            <th>Pilih</th>
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
        <tr class="clickable-row" data-id='{{ $item->id }}'>
            <td><input type="checkbox" name="jadwal_id[]" id="jadwal_id" value="{{ $item->id }}"></td>
            <td>{{ $item->hari }}</td>
            <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
            <td>{{ $item->matkul->nm_matkul }}</td>
            <td>{{ $item->matkul->kd_matkul }}</td>
            <td>{{ $item->matkul->sks }}</td>
            <td>{{ $item->prodi->kd_prodi }}-{{ $item->matkul->semester }}</td>
            <td>{{ $item->ruang->kd_ruang }}</td>
            <td>{{ $item->dosen->nm_dosen }}</td>
        </tr>
        @endforeach
    </tbody>
</table>



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
        let tableKontrak= $('.tableKontrak')
        tableKontrak.DataTable({
            "scrollX": true,
            "paging":   false,
        })
    })
</script>

