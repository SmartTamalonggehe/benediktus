<table class="tableKu table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th></th>
        </tr>
    </thead>
    <tbody>



        @foreach ($kontrak as $item)
        <tr>
            <td></td>
            <td>{{ $item->krs->perwalian->mhs->NPM }}</td>
            <td>{{ $item->krs->perwalian->mhs->nm_mhs }}</td>
            <td>
                @forelse ($nilai as $itemNilai)
                    @if ($item->krs->perwalian->mhs->NPM==$itemNilai->kontrak->krs->perwalian->mhs->NPM)
                    {{-- Tombol Ubah nilai --}}
                    <button type="submit" data-id="{{ $item->krs->id }}" class="btn btn-info float-left ubahNilai mr-2">Ubah Nilai</button>
                    @else
                    <button type="submit" data-id="{{ $item->krs->id }}" class="btn btn-primary float-left tambahNilai">Input Nilai</button>
                    @endif
                @empty
                <button type="submit" data-id="{{ $item->krs->id }}" class="btn btn-primary float-left tambahNilai">Input Nilai</button>
                @endforelse

            </td>
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

    // input nilai
    function getData(krs_id) {
        $.ajax({
            url: "/staf/nilai/"+krs_id,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                $('#tableNilai').empty();
                // lakukan sesuatu sebelum data dikirim
                },
            success: function(data) {
                console.log(krs_id);
                console.log(data);

                // lakukan sesuatu jika data sudah terkirim
                if (save_method=="add") {
                    $.each(data.kontrak, tampilData);
                }else{
                    $.each(data.nilai, tampilEdit);
                }

                $('.tampilModal').modal('show')
            }
        });
    };

    // tampilkan Tambah Data
    function tampilData(key,val) {
        $('#tableNilai').append(
            "<tr>"+
                "<td>"+ val.jadwal.matkul.kd_matkul+
                    "<input type='hidden' name='kontrak_id[]' value="+val.id+">"+
                "</td>"+
                "<td>"+ val.jadwal.matkul.nm_matkul +"</td>"+
                "<td>"+
                    "<select class='form-control' name='nilai[]'>"+
                        "<option value='E'>E</option>"+
                        "<option value='D'>D</option>"+
                        "<option value='C'>C</option>"+
                        "<option value='B'>B</option>"+
                        "<option value='A'>A</option>"+
                    "</select>"+
                "</td>"
            +"</tr>"
        );
        $('#tombolForm').html('Simpan Nilai')
    }
    // tampilkan Edit Data
    function tampilEdit(key,val) {
        nilai_E= val.nilai=='E' ? 'selected' : '';
        nilai_D= val.nilai=='D' ? 'selected' : '';
        nilai_C= val.nilai=='C' ? 'selected' : '';
        nilai_B= val.nilai=='B' ? 'selected' : '';
        nilai_A= val.nilai=='A' ? 'selected' : '';
        $('#tableNilai').append(
            "<tr>"+
                "<td>"+ val.kontrak.jadwal.matkul.kd_matkul+
                    "<input type='hidden' class='id' name='kontrak_id[]' value="+val.id+">"+
                "</td>"+
                "<td>"+ val.kontrak.jadwal.matkul.nm_matkul +"</td>"+
                "<td>"+
                    "<select class='form-control nilai' name='nilai[]'>"+
                        "<option "+ nilai_E +" value='E'>E</option>"+
                        "<option "+ nilai_D +" value='D'>D</option>"+
                        "<option "+ nilai_C +" value='C'>C</option>"+
                        "<option "+ nilai_B +" value='B'>B</option>"+
                        "<option "+ nilai_A +" value='A'>A</option>"+
                    "</select>"+
                "</td>"
            +"</tr>"
        );
        $('#tombolForm').html('Ubah Nilai')
    }

    $('.tambahNilai').on('click', function(){
        krs_id=$(this).data('id')
        save_method="add"
        getData(krs_id)
    });
    $('.ubahNilai').on('click', function(){
        krs_id=$(this).data('id')
        save_method="ubah"
        getData(krs_id)
    })
</script>

{{-- Table --}}
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


