@php
    use Carbon\Carbon;
@endphp

{{-- Komentar Perwalian --}}

@foreach ($komen as $item)
    @if ($item->id_pengkomen==auth()->user()->id)
        <!-- Sender Message-->
        <div class="media w-50 mb-3">
            <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-muted">{{ $item->pesan }}</p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
            </div>
        </div>
    @else
        <!-- Reciever Message-->
        <div class="media w-50 ml-auto mb-3">
            <div class="media-body">
            <div class="bg-primary rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-white">{{ $item->pesan }}</p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
            </div>
        </div>
    @endif



@endforeach


{{-- Tap Jadwal --}}
{{-- <script>
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
</script> --}}
