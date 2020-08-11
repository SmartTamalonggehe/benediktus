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
                        <div class="col-12">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="dosen_id">Dosen Wali</label>
                                  <select name="dosen_id" id="dosen_id" class="select2 form-control" style="width: 100%" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Dosen Wali</option>
                                      @foreach ($dosen as $item)
                                          <option value="{{ $item->id }}">{{ $item->NIDN }} - {{ $item->nm_dosen }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="mhs_id">Mahasiswa</label>
                                  <select name="mhs_id" id="mhs_id" class="select2 form-control" style="width: 100%" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Mahasiswa</option>
                                  </select>
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
