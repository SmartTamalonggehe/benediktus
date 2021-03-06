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
                        <div class="col-sm-5 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="kd_ruang">Kode Ruang</label>
                                    <input type="text" name="kd_ruang" id="kd_ruang" class="form-control" required data-validation-required-message="Tidak Boleh Kosong" autocomplete="off">
                                </div>
                                <div></div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-8 col-xl-8">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="nm_ruang">Nama Ruang</label>
                                    <input type="text" name="nm_ruang" id="nm_ruang" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                </div>
                            </div>
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
