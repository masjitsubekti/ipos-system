<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formData" action="" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="modeform" id="modeform">
          <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($data) ? $data['id'] : '' }}"></input>
          <div class="form-group">
            <label for="kategori">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode . . ." value="{{ isset($data) ? $data['kode'] : '' }}" required>
          </div>
          <div class="form-group">
            <label for="kategori">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama . . ." value="{{ isset($data) ? $data['nama'] : '' }}" required>
          </div>
          <div class="form-group">
            <label for="kategori">No Telepon / HP</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telepon / HP . . ." value="{{ isset($data) ? $data['no_telp'] : '' }}" required>
          </div>
          <div class="form-group">
            <label for="kategori">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" placeholder="Alamat . . ." required>{{ isset($data) ? $data['alamat'] : '' }}</textarea>
          </div>
          <div class="form-group">
            <label for="kategori">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="2" class="form-control" placeholder="Keterangan . . .">{{ isset($data) ? $data['keterangan'] : '' }}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>