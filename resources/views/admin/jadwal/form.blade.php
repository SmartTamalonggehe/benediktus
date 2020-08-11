<div class="modal fade tampilModal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="judul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formKu" class="custom-validation">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" id="prodi_id" name="prodi_id" value="{{ $prodi->id }}">
                    <div class="row">
                      <div class="col-sm-12 col-lg-6 col-xl-6">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="tahun_ak">Tahun</label>
                                  <select style="width: 100%" name="tahun_ak" id="tahun_ak" class="select2 form-control" required>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="semester_ak">Semester</label>
                                <select style="width: 100%" name="semester_ak" id="semester_ak" class="select2 form-control" required>
                                  <option value="GANJIL">GANJIL</option>
                                  <option value="GENAP">GENAP</option>
                              </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="matkul_id">Mata Kuliah</label>
                                <select style="width: 100%" name="matkul_id" id="matkul_id" class="select2 form-control" required>
                                    <option value="">Pilih Matkul</option>
                                  @foreach ($matkul as $item)
                                      <option value="{{ $item->id }}">{{ $item->kd_matkul }} - {{ $item->nm_matkul }}</option>
                                  @endforeach
                               </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="ruang_id">Pilih Ruangan</label>
                                <select style="width: 100%" name="ruang_id" id="ruang_id" class="select2 form-control" required>
                                    <option value="">Pilih Ruang</option>
                                  @foreach ($ruang as $item)
                                      <option value="{{ $item->id }}">{{ $item->nm_ruang }}</option>
                                  @endforeach
                               </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <div class="controls">
                                <label for="dosen_id">Dosen</label>
                                <select style="width: 100%" name="dosen_id" id="dosen_id" class="select2 form-control" required>
                                    <option value="">Pilih Dosen</option>
                                  @foreach ($dosen as $item)
                                      <option value="{{ $item->id }}">{{ $item->NIDN }}-{{ $item->nm_dosen }}</option>
                                  @endforeach
                               </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <div class="controls">
                                <label for="hari">Hari</label>
                                <select style="width: 100%" name="hari" id="hari" class="select2 form-control" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                               </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-3 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <div class="controls">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-3 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <div class="controls">
                                <label for="jam_seles">Jam Selesai</label>
                                <input type="time" name="jam_seles" id="jam_seles" class="form-control" required>
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
