<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BarangController extends Controller
{
    public function index(Request $request)
    {   
        $data = [];
        $q = $request->get('q');
        return view('barang.index', compact('data', 'q'));
    }

    public function fetch_data(Request $request)
    {
        $limit = $request->get('limit');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        $q = $request->get('q');
        $q = str_replace(" ", "%", $q);

        $data = DB::table('m_barang')
                    ->where(DB::raw('concat(kode, nama)'), 'like', '%'.$q.'%')
                    ->orderBy($sortBy, $sortType)
                    ->paginate($limit);
                    
        $data->appends($request->all());
        return view('barang.list_data', compact('data'));
    }

    public function create(Request $request)
    {
      $listSatuan = Satuan::orderBy('nama', 'asc')->get();
      $listJenisBarang = JenisBarang::orderBy('nama', 'asc')->get();

      $data['modeform'] = 'ADD';
      $data['satuan'] = $listSatuan;
      $data['jenis_barang'] = $listJenisBarang;
      return view('barang.form_barang', $data);
    }

    public function edit($id)
    {
      $listSatuan = Satuan::orderBy('nama', 'asc')->get();
      $listJenisBarang = JenisBarang::orderBy('nama', 'asc')->get();
      $barang = Barang::findOrFail($id);
      // $barang = Barang::where('id_barang', $id)->first();

      $data['modeform'] = 'UPDATE';
      $data['satuan'] = $listSatuan;
      $data['jenis_barang'] = $listJenisBarang;
      $data['data'] = $barang;
      return view('barang.form_barang', $data);
    }

    public function save(Request $request)
    {
      try {
          $input = [
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
          ];
          $rules = [
            'kode' => 'required',
            'nama' => 'required',
          ];
          $messages = [
            'kode.required' => 'Kode wajib diisi',
            'nama.required' => 'Jenis barang wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
          }
          
          // Handle Save
          $data = new Barang();
          $data->id_barang = Uuid::uuid4()->toString();
          $data->kode = $request->kode;
          $data->nama = $request->nama;
          $data->deskripsi = $request->deskripsi;
          $data->id_jenis_barang = $request->jenis_barang;
          $data->id_satuan = $request->satuan;
          $data->harga_beli = $request->harga_beli;
          $data->harga_jual = $request->harga_jual;
          $data->stok = $request->stok;
          $data->status = '1';
          $data->save();
  
          return redirect('master/barang')->with('success', 'Barang berhasil disimpan');
      } catch (Exception $e) {
          return redirect()->back()->with('error', 'Barang gagal disimpan');
      }
    }

    public function update(Request $request)
    {
      try {
          $input = [
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
          ];
          $rules = [
            'kode' => 'required',
            'nama' => 'required',
          ];
          $messages = [
            'kode.required' => 'Kode wajib diisi',
            'nama.required' => 'Jenis barang wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $id = $request->id;
          $data = Barang::find($id)
          ->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'id_jenis_barang' => $request->jenis_barang,
            'id_satuan' => $request->satuan,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
          ]); 

          return redirect('master/barang')->with('success', 'Barang berhasil diubah');
      } catch (Exception $e) {
          return redirect()->back()->with('error', 'Barang gagal disimpan');
      }
    }

    public function delete($id)
    { 
        Barang::where("id_barang", $id)->delete();
        $response['success'] = true;
        $response['message'] = "Data berhasil dihapus";
        return response()->json($response);
    }
}
