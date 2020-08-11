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
                        <div class="col-sm-12 col-lg-7 col-xl-7">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="nm_tool">Nama</label>
                                    <input type="text" name="nm_tool" id="nm_tool" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-5 col-xl-5">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="id_prodi">Progdi</label>
                                  <select style="width: 100%" name="id_prodi" id="id_prodi" class="form-control select2" required>
                                      <option value="">Pilih Prodi</option>
                                      @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nm_prodi }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-6">
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
                        <div class="col-12 col-lg-6 col-xl-6 d-none">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="jabatan">Jabatan</label>
                                  <select name="jabatan" id="jabatan" class="form-control select2" required>
                                    {{-- <option value="">Pilih Jabatan</option>
                                    <option value="Ketua Prodi">Ketua Prodi</option> --}}
                                    <option selected value="Staf">Staf</option>
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-6">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="username">Username</label>
                                  <input type="text" name="username" id="username" class="form-control" required>
                              </div>
                          </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" required>
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
