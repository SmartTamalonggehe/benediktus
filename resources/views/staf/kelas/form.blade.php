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
                    <p class="ketForm"></p>
                <input type="hidden" id="jadwal_id" name="jadwal_id">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <div class="controls">
                            <label for="nm_kelas">Nama Kelas</label>
                            <select name="nm_kelas" id="nm_kelas" class="form-control">
                              <option value=""></option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <div class="controls">
                          <label for="kuota">Kuota</label><br>
                            <div class="d-inline-block mb-1">
                              <div class="input-group">
                                  <input type="text" name="kuota" id="kuota" class="verticalUpDown nomor" value="0">
                              </div>
                          </div>
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
