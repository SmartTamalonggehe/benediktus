<div class="table-responsive mb-0">
    <table class="tableKu table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tbody>
            <tr>
                <td width=120px>Foto KHS</td>
                <td>
                    <div class="col-6">
                        <div>
                            <a class="image-popup-no-margins" href="{{ asset($khs->gambar_khs) }}">
                                <img class="img-fluid" alt="" src="{{ asset($khs->gambar_khs) }}" width="200">
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @if ($khs->status=='Belum')
            <tr>
                <td>Status</td>
                <td>{{ $khs->status }} Dikonfirmasi</td>
            </tr>
            <tr>
                <td>Aksi</td>
                <td>
                    <button id="btnUbah" data-id="{{ $khs->id }}" class="btn btn-primary">Ubah Gambar</button>
                </td>
            </tr>
            @else
            <tr>
                <td>IPK</td>
                <td>{{ $khs->IPK }}</td>
            </tr>
            @endif

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
<!-- Responsive examples -->
<script src="{{ asset('assetsAdmin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assetsAdmin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>


<script>
    $('#btnUbah').off('click').on('click',function(e){
        e.preventDefault()
        $('.gambar_khs').val('');
        save_method="Ubah"
        href=$(this).data('id');
        $.ajax({
            url: "mhsKhs/"+href+"/edit",
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                // lakukan sesuatu sebelum data dikirim
                },
            success: function(data) {
                $('#id').val(data.id);
                // lakukan sesuatu jika data sudah terkirim
                $('.tampilModal').modal('show')
                $('#judul').html('Silahkan Merubah Data')
                $('#tombolForm').html('Ubah Data')
            }
        });

    });

</script>


