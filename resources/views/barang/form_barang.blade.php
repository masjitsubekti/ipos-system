@extends('layouts.main')
@section('content')
<div class="row">
  <div class="col-12">
    @include('layouts.notif')
    <div class="card flat">
      <div class="card-header card-header-blue">
          <span class="card-title">Tambah Barang</span>
      </div>
      <div class="card-body">
        <form id="formData" action="{{ ($modeform=='ADD') ? url('/barang/save') : url('/barang/update') }}" method="POST">
          @csrf
          <input type="hidden" name="modeform" id="modeform">
          <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($data) ? $data['id_barang'] : '' }}"></input>
          <div class="mb-2 row">
            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode . . . " value="{{ isset($data) ? $data['kode'] : '' }}">
            </div>
          </div>
          <div class="mb-2 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang . . . " value="{{ isset($data) ? $data['nama'] : '' }}">
            </div>
          </div>
          <div class="mb-2 row">
            <label for="jenis_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-5">
              <Select class="form-control" name="jenis_barang" id="jenis_barang">
                <option value="">-Pilih jenis barang-</option>  
                @foreach ($jenis_barang as $item)
                  <option 
                  @if (isset($data))
                    @if ($data['id_jenis_barang']==$item->id)
                      {{ 'selected ' }}
                    @endif
                  @endif
                  value="{{ $item->id }}">{{ $item->nama }}</option>  
                @endforeach
              </Select>
            </div>
          </div>
          <div class="mb-2 row">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan Barang</label>
            <div class="col-sm-5">
              <Select class="form-control" name="satuan" id="satuan">
                <option value="">-Pilih satuan barang-</option>
                @foreach ($satuan as $item)
                  <option 
                  @if (isset($data))
                    @if ($data['id_satuan']==$item->id)
                      {{ 'selected ' }}
                    @endif
                  @endif
                  value="{{ $item->id }}">{{ $item->nama }}</option>  
                @endforeach
              </Select>
            </div>
          </div>
          <div class="mb-2 row">
            <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli . . . " value="{{ isset($data) ? $data['harga_beli'] : '' }}">
            </div>
          </div>
          <div class="mb-2 row">
            <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual . . . " value="{{ isset($data) ? $data['harga_jual'] : '' }}">
            </div>
          </div>
          <div class="mb-2 row">
            <label for="stok" class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok . . . " value="{{ isset($data) ? $data['stok'] : '' }}">
            </div>
          </div>
          <div class="mb-2 row">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="3" placeholder="Deskripsi . . .">{{ isset($data) ? $data['deskripsi'] : '' }}</textarea>
            </div>
          </div>
          <hr class="mt-4 mb-3">
          <div class="text-right">
            <a href="{{ url('/master/barang') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="div_modal"></div>
@endsection
@section('js')

@endsection
