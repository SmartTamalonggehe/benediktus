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
                        <div class="col-12 col-md-5 mt-2">
                            <label for="NIDN">NIDN</label>
                              <input type="text" name="NIDN" id="NIDN" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-12 mt-2">
                            <label for="nm_dosen">Nama Dosen</label>
                              <input type="text" name="nm_dosen" id="nm_dosen" class="form-control">
                        </div>
                        <div class="col-12 col-md-5 mt-2">
                            <label>Jenis Kelamin</label>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" id="laki" name="jenkel" checked value="Laki-laki">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <label for="laki">Laki-Laki</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" id="perem" name="jenkel" value="Perempuan">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <label for="perem">Perempuan</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>

                        </div>
                        <div class="col-12 col-md-5 mt-2">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control select2" style="width: 100%">
                                <option value="">Pilih Status</option>
                                <option value="Tetap">Tetap</option>
                                <option value="Tidak Tetap">Tidak Tetap</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12 mt-2">
                            <label for="alamat">Alamat</label>
                              <input type="text" name="alamat" id="alamat" class="form-control">
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
