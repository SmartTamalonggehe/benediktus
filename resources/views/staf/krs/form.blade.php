<div class="modal fade tampilModal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                        <div class="col-6">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="tahun_ak_form">Tahun</label>
                                  <select name="tahun_ak" id="tahun_ak_form" class="tahun_ak select2 form-control" style="width: 100%" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Tahun</option>
                                      @foreach ($jadwal->keyBy('tahun_ak') as $item)
                                        <option value="{{ $item->tahun_ak }}">{{ $item->tahun_ak }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="semester_form">Pilih Tahun</label>
                                  <select name="semester_ak" id="semester_form" class="semester_ak select2 form-control" style="width: 100%" required data-validation-required-message="Tidak Boleh Kosong">
                                    <option value="">Pilih Semester</option>
                                    <option value="GANJIL">Ganjil</option>
                                    <option value="GENAP">Genap</option>

                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="perwalian_id">Mahasiswa</label>
                                  <select name="perwalian_id" id="mhs_id" class="select2 form-control" style="width: 100%" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Mahasiswa</option>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="tgl_krs">Tgl KRS</label>
                                    <input type="date" name="tgl_krs" id="tgl_krs" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                </div>
                            </div>
                        </div>
                        {{-- Tabel Matkul --}}
                        <div class="col-12">
                            <div id="tampilJadwal"></div>
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


<div class="modal fade tampilDetail" id="tampilDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div id="tampilDetailKontrak"></div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
