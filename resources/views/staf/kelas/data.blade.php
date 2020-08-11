<?php
use Carbon\Carbon;
?>
<style>
    .hilang {
        display: none;
        text-transform:uppercase;
    }
</style>
<div class="table-responsive mb-0">
    <table class="tableKu table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Ruang</th>
                <th>Kelas</th>
                <th>Kuota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $item)
            <tr class="clickable-row" data-id='{{ $item->id }}' data-id_jadwal="{{ $item->jadwal_ku }}">
                <td>{{ $item->hari }}</td>
                <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
                <td>{{ $item->matkul->kd_matkul }}</td>
                <td id="{{ $item->jadwal_ku }}">{{ $item->matkul->nm_matkul }}</td>
                <td>{{ $item->ruang->kd_ruang }}</td>
                @if ($item->id)
                    <td>{{ $item->nm_kelas }}</td>
                    <td>{{ $item->kuota }}</td>
                @else
                    <td></td>
                    <td><button id="tambah" type="button" data-id="{{ $item->jadwal_ku }}" class="btn btn-primary btn-relief-info">
                        <i class="feather icon-plus-circle"></i> Tambah Data
                    </button> </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
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

<script>
    // Tampilkan Modal Tambah
    $('button#tambah').on('click',function(e){
        e.preventDefault();
        let id_jadwal=$(this).data('id');
        console.log(id_jadwal);
        let nm_matkul=$('#'+id_jadwal).html();
        save_method="add"
        $('#judul').html('Tambah Kelas')
        $('.ketForm').html('Silahkan Menambah Kelas / Kuota Kelas Untuk Matakuliah '+nm_matkul)
        $('#jadwal_id').val(id_jadwal)
        $('#tombolForm').html('Simpan Data')
        $('.tampilModal').modal('show')
        $('#nm_kelas').val('')
        $('#kuota').val(0)
    });
</script>

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
            url: "kelas/"+href+"/edit",
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                // lakukan sesuatu sebelum data dikirim
                console.log(href);
                },
            success: function(data) {
                // lakukan sesuatu jika data sudah terkirim
                // lakukan sesuatu jika data sudah terkirim
                $('#id').val(data.id);
                $('#jadwal_id').val(data.jadwal_id);
                $('#nm_kelas').val(data.nm_kelas);
                $('#kuota').val(data.kuota);
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
                url: "kelas/"+href,
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
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print'
            ]
        });
    });
</script>



