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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="syarat_id">Syarat Matkul</label>
                                    <select style="width: 100%" name="syarat_id" id="syarat_id" class="select2 form-control" required>
                                        <option value="">Pilih Syarat</option>
                                      @foreach ($matkul as $item)
                                          <option value="{{ $item->id }}">{{ $item->kd_matkul }} - {{ $item->nm_matkul }}</option>
                                      @endforeach
                                   </select>
                                </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
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
