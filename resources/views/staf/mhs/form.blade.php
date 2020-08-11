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
                        <div class="col-sm-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="NPM">NPM </label>
                                    <input type="text" name="NPM" id="NPM" class="nomor form-control" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" data-validation-required-message="10 Digit Terakhir" maxlength="10" minlength="10" placeholder="10 Digit Terakhir">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-8 col-xl-8">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="nm_mhs">Nama Mahasiswa</label>
                                    <input type="text" name="nm_mhs" id="nm_mhs" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-8 col-xl-8">
                            <div class="form-group">
                                <div class="controls">
                                  <label class="d-block">Jenis Kelamin</label>
                                  <div class="custom-control custom-radio mb-2 mr-2 d-inline">
                                    <input type="radio" id="laki" checked value="Laki-laki" name="jenkel" class="custom-control-input">
                                    <label class="custom-control-label" for="laki">Laki-Laki</label>
                                  </div>
                                  <div class="custom-control custom-radio mb-2 d-inline">
                                    <input type="radio" id="Perempuan" value="Perempuan" name="jenkel" class="custom-control-input">
                                    <label class="custom-control-label" for="Perempuan">Perempuan</label>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 col-xl-4">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="angkatan">Angkatan</label>
                                  <select name="angkatan" id="angkatan" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="alamat">Alamat</label>
                                  <input type="text" name="alamat" id="alamat" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
