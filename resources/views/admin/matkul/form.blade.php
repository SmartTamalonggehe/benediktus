<div class="modal fade tampilModal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="judul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formKu" class="custom-validation">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-4 mt-2">
                            <label for="kd_matkul">Kode Matkul</label>
                            <input type="text" name="kd_matkul" id="kd_matkul" class="form-control" required >
                        </div>
                        <div class="col-12 col-md-8 mt-2">
                            <label for="nm_matkul">Nama Matkul</label>
                            <input type="text" name="nm_matkul" id="nm_matkul" class="form-control" required >
                        </div>
                        <div class="col-12 col-md-5 mt-2">
                            <label for="sks">SKS</label>
                            <input type="text" name="sks" id="sks" class="form-control verticalUpDown nomor" required >
                        </div>
                        <div class="col-12 col-md-7 mt-2">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="select2 form-control" style="width: 100%" required >
                                <option value="">Semester</option>
                                @for ($i = 1; $i <= 8; $i++)
                                  <option value="{{ $i }}">Semester {{ $i }}</option>
                                @endfor
                                <option value="Pilihan">Smester Pilihan</option>
                             </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="tombolForm" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
