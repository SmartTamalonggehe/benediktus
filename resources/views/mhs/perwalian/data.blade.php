@php
    use Carbon\Carbon;
@endphp

{{-- Jadwal --}}
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Jadwal Perkulihan</h4>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary float-right">Download Jadwal</button>
                </div>
            </div>
            <p class="card-title-desc">Silahkan memilih matakuliah yang akan dikontrak. Total sks matakuliah yang dikontrak tidak boleh lebih dari beban SKS {{ $beban }}</p>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($semester as $itemSemester)
                <li class="nav-item tabJadwal">
                    <a class="nav-link ambilSemester" data-id="{{ $itemSemester->matkul->semester }}" data-toggle="tab" href="#semester{{ $itemSemester->matkul->semester }}" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">Semester {{ $itemSemester->matkul->semester }}</span>
                    </a>
                </li>
                @endforeach
            </ul>


            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                @foreach ($semester as $itemSemester)
                <div class="tab-pane" id="semester{{ $itemSemester->matkul->semester }}" role="tabpanel">

                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Kode MK</th>
                                <th>SKS</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                            @if ($item->matkul->semester==$itemSemester->matkul->semester)
                            <tr class="clickable-row" data-id='{{ $item->id }}'>
                                <td>{{ $item->hari }}</td>
                                <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
                                <td>{{ $item->matkul->nm_matkul }}</td>
                                <td>{{ $item->matkul->kd_matkul }}</td>
                                <td>{{ $item->matkul->sks }}</td>
                                <td>{{ $item->ruang->kd_ruang }}</td>
                                <td>{{ $item->dosen->nm_dosen }}</td>
                                <td>
                                        <input type="checkbox" name="jadwal_id[]" value="{{ $item->id }}" data-sks="{{ $item->matkul->sks }}" class="ambilMatkul">
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
                @endforeach
                <div class="row mt-5">
                    <div class="col-8">
                        <span id="beban" data-id="{{ $beban }}">Beban SKS: {{ $beban }} <br></span>
                        <span id="dikontrak">Dikontrak: 0</span>
                        <span id="peringatan" class="text-danger" style="display: none">SKS yang dikontak melebihi<br></span>
                    </div>
                    <div class="col-4">
                        <button id="tanyaKirim" class="btn btn-primary float-right">Kirim</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Tap Jadwal --}}
<script>
    $(document).ready(function () {
        $('.tabJadwal a:first').addClass('active');
        $('.tab-content.p-3.text-muted div:first').addClass('active');

        // checkbox
        $(':checkbox:checked').prop('checked',false);

        let beban=$('#beban').data('id')
        let dicek=0;
        let jadwal_id=[];
        $('input[type=checkbox].ambilMatkul').on('click', function(){
            if($(this).prop("checked") == true){
                dicek+=Number($(this).data('sks'))
                jadwal_id.push($(this).val())
            }
            else if($(this).prop("checked") == false){
                dicek-=Number($(this).data('sks'))
                hapus_id=$(this).val();
                jadwal_id = jQuery.grep(jadwal_id, function(value) {
                    return value != hapus_id;
                });
            }
            $('#dikontrak').text('Dikontrak: '+dicek);

            if (beban >= dicek) {
                $('button#tanyaKirim').show();
                $('span#peringatan').hide();
            }
            else {
                $('button#tanyaKirim').hide();
                $('span#peringatan').show();
                }
        });

        // Kirim Kontrak
        $('button#tanyaKirim').on('click', function(){
            if (dicek==0) {
                alert('Anda Belum Memilih')
                return 0
            }
            var csrf_token=$('meta[name="csrf_token"]').attr('content')
            $.ajax({
            url: "{{ route('mhsPerwalian.store') }}",
            type : "POST",
            data: {
                '_token' :csrf_token,
                'jadwal_id': jadwal_id,
            },
            success: function(response) {
                    console.log(response);
                // loadMoreData();
                //   pesan
                }
            })
        })
    });
 </script>
