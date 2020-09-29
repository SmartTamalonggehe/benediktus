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
                <th>No.</th>
                <th>NPM</th>
                <th>Nama Mhs</th>
                <th>Semester</th>
                <th>Tahun</th>
                <th>Gambar KHS</th>
                <th>IPK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khs as $item)
            <tr class="clickable-row" data-status="{{ $item->status }}" data-id='{{ $item->id }}'>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->mhs->NPM }}</td>
                <td>{{ $item->mhs->nm_mhs }}</td>
                <td>{{ $item->semester_ak }}</td>
                <td>{{ $item->tahun_ak }}</td>
                <td>
                    <div class="zoom-gallery">
                        <a class="float-left" href="{{ asset($item->gambar_khs) }}" title="Project 1"><img src="{{ asset($item->gambar_khs) }}" alt="" width="100"></a>
                    </div>
                </td>
                @if ($item->status=="Aktif")
                    <td>{{number_format ($item->IPK,2) }}</td>
                @else
                    <td><button id="tambah" type="button" data-id="{{ $item->id }}" class="btn btn-primary btn-relief-info">
                        <i class="feather icon-plus-circle"></i> Input IPK
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

<!-- Magnific Popup-->
<script src="{{ asset('assetsAdmin/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

<!-- Tour init js-->
<script src="{{ asset('assetsAdmin/js/pages/lightbox.init.js') }}"></script>


<script>
    // Tampilkan Modal Tambah
    $('button#tambah').on('click',function(e){
        e.preventDefault();
        let id=$(this).data('id');
        console.log(id);
        save_method="Ubah"
        $('#judul').html('Tambah Kelas')
        $('.ketForm').html('Silahkan Menambah Data IPK')
        $('#id').val(id)
        $('#IPK').val('')
        $('#tombolForm').html('Simpan Data')
        $('.tampilModal').modal('show')
    });
</script>

<script>
    var href;
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            href= $(this).data('id');
            let status= $(this).data('status');
            if (status!=="Aktif") {
                alert('IPK belum Diinput')
                return 0;
            }
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
            url: "khs/"+href+"/edit",
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
                $('#IPK').val(data.IPK);
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
                url: "khs/"+href,
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



