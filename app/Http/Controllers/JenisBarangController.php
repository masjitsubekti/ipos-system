<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function index(Request $request)
    {   
        $data = [];
        $q = $request->get('q');
        return view('jenis_barang.index', compact('data', 'q'));
    }

    public function fetch_data(Request $request)
    {
        $limit = $request->get('limit');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        $q = $request->get('q');
        $q = str_replace(" ", "%", $q);

        $data = DB::table('jenis_barang')
                    ->where('nama', 'like', '%'.$q.'%')
                    ->orderBy($sortBy, $sortType)
                    ->paginate($limit);
                    
        $data->appends($request->all());
        return view('jenis_barang.list_data', compact('data'));
    }

    public function save(Request $request)
    {
      try {
          $input = [
            'nama' => $request->input('nama'),
          ];
          $rules = [
            'nama' => 'required',
          ];
          $messages = [
            'nama.required' => 'Jenis barang wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $data = new JenisBarang();
          $data->nama = $request->nama;
          $data->status = '1';
          $data->save();

          return redirect()->back()->with('success', 'Jenis barang berhasil disimpan');
      } catch (Exception $e) {
          return redirect()->back()->with('error', 'Jenis barang gagal disimpan');
      }
    }

    public function update(Request $request)
    {
      try {
          $input = [
            'nama' => $request->input('nama'),
          ];
          $rules = [
            'nama' => 'required',
          ];
          $messages = [
            'nama.required' => 'Jenis barang wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          // $data = JenisBarang::whereId($request->id)->firstOrFail();
          $id = $request->id;
          $data = JenisBarang::find($id)
          
          // JenisBarang::where('id', $id)
          ->update([
            'nama' => $request->nama
          ]); 

          return redirect()->back()->with('success', 'Jenis barang berhasil diupdate'.print_r($request->id));
      } catch (Exception $e) {
          return redirect()->back()->with('error', 'Jenis barang gagal diupdate');
      }
    }

    public function delete($id)
    { 
      JenisBarang::where("id", $id)->delete();
      return redirect()->back()->with('success', 'Jenis barang berhasil dihapus');
    }
}
