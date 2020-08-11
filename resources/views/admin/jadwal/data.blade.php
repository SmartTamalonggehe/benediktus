<?php
use Carbon\Carbon;
?>
<style>
    .hilang {
        display: none;
        text-transform:uppercase;
    }
</style>
<table class="tableKu table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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

        @foreach ($jadwal as $item)
        <tr class="clickable-row" data-id='{{ $item->id }}'>
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
    var href;
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            href= $(this).data('id');
            $('#alertPertanyaan').modal('show')
        });
    });
</script>

<script>
    $('#btnUbah').off('click').on('click',function(e){
        e.preventDefault()
        $('#alertPertanyaan').modal('hide')
        save_method="Ubah"
        $.ajax({
            url: href+"/edit",
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                // lakukan sesuatu sebelum data dikirim
                console.log(href);
                },
            success: function(data) {
                $('#id').val(data.id);
                $('#matkul_id').val(data.matkul_id).trigger('change');
                $('#ruang_id').val(data.ruang_id).trigger('change');
                $('#dosen_id').val(data.dosen_id).trigger('change');
                $('#hari').val(data.hari).trigger('change');
                $('#jam_mulai').val(data.jam_mulai);
                $('#jam_seles').val(data.jam_seles);
                $('.tampilModal').modal('show')
                $('#judul').html('Silahkan Merubah Data')
                $('#tombolForm').html('Ubah Data')
                $('.tampilModal').modal('show')
                $('#judul').html('Silahkan Merubah Data')
                $('#tombolForm').html('Ubah Data')
            }
        });

    });
    $('#btnHapus').on('click',function(){
        $('#alertPertanyaan').modal('hide')
        var csrf_token=$('meta[name="csrf_token"]').attr('content');
        Swal.fire({
        title: 'Yakin?',
        text: "Data akan dihapus secara permanen!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
        }).then(function (result) {
        if (result.value) {
            $.ajax({
                url:href,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' :csrf_token},
                success: function(response) {
                    Swal.fire({
                            type: "success",
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            confirmButtonClass: 'btn btn-success',
                        })
                    loadMoreData();
                    }
                })
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.tableKu').DataTable({
            "ordering": false,
        });
    });
</script>


