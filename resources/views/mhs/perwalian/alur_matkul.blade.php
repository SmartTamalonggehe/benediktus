<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                @foreach ($syarat as $item)
                        <h6 class=" text-danger">Tidak Bisa Mengontrak {{ $item->matkul->nm_matkul }}, Belum Lulus {{ $item->syarat->nm_matkul }}</h6>
                @endforeach
            </div>
        </div>
    </div>
</div>
