<table class="tableKu table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>Mata Kuliah</th>
            <th>Kode MK</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Ruang</th>
            <th>SKS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kontrak as $itemKontrak)
            @foreach ($jadwal as $item)
            @if ($item->id==$itemKontrak->jadwal_id)
            <tr class="clickable-row" data-id='{{ $item->id }}'>
                <td>{{ $item->matkul->nm_matkul }}</td>
                <td>{{ $item->matkul->kd_matkul }}</td>
                <td>{{ $item->hari }}</td>
                <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
                <td>{{ $item->ruang->kd_ruang }}</td>
                <td>{{ $item->matkul->sks }}</td>
            </tr>
            @endif
            @endforeach
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
        $("#mhs_id option").remove();
        $.ajax({
            url: "perwalian/"+href+"/edit",
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                href="";
                // lakukan sesuatu sebelum data dikirim
                },
            success: function(data) {
                // lakukan sesuatu jika data sudah terkirim
                $('#id').val(data.id);
                $('#dosen_id').val(data.dosen_id).trigger('change');
                $('#mhs_id').append('<option>'+data.mhs.nm_mhs+'</option>');
                $("#mhs_id option[value='']").remove();
                $('.tampilModal').modal('show')
                $('#judul').html('Silahkan Merubah Dosen Wali Dari' + data.mhs.nm_mhs)
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
                url: "perwalian/" + href,
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
            let table = $('.tableKu').DataTable( {
                "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
                } ],
                order: [[ 1, "desc" ]],
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ]
            });

            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
        }).draw();
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    });
</script>


