<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {   
        $data = [];
        $q = $request->get('q');
        return view('supplier.index', compact('data', 'q'));
    }

    public function fetch_data(Request $request)
    {
        $limit = $request->get('limit');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        $q = $request->get('q');
        $q = str_replace(" ", "%", $q);

        $data = DB::table('m_supplier')
                    ->where('nama', 'like', '%'.$q.'%')
                    ->orderBy($sortBy, $sortType)
                    ->paginate($limit);
                    
        $data->appends($request->all());
        return view('supplier.list_data', compact('data'));
    }

    public function load_modal(Request $request)
    {
      $id = $request->id;
      if ($id != "") {
        $data['mode'] = "UPDATE";
        $data['data'] = Supplier::find($id);	
      } else {
        $data['mode'] = "ADD";
      }
      return view('supplier.form_modal', $data);
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
            'nama.required' => 'Nama wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
              $response['success'] = false;
              $response['message'] = "Harap lengkapi isian dengan benar";
              return response()->json($response);
          }
          
          // Handle Save
          $data = new Supplier();
          $data->kode = $request->kode;
          $data->nama = $request->nama;
          $data->no_telp = $request->no_telp;
          $data->alamat = $request->alamat;
          $data->keterangan = $request->keterangan;
          $data->status = '1';
          $data->save();
          
          $response['success'] = true;
          $response['message'] = "Data berhasil disimpan";
          return response()->json($response);
      } catch (Exception $e) {
          $response['success'] = false;
          $response['message'] = "Data gagal disimpan";
          return response()->json($response);
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
            'nama.required' => 'Nama wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
              $response['success'] = false;
              $response['message'] = "Harap lengkapi isian dengan benar";
              return response()->json($response);
          }

          $id = $request->id;
          $data = Supplier::find($id)
          ->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
          ]); 

          $response['success'] = true;
          $response['message'] = "Data berhasil diubah";
          return response()->json($response);
      } catch (Exception $e) {
          $response['success'] = false;
          $response['message'] = "Data gagal disimpan";
          return response()->json($response);
      }
    }

    public function delete($id)
    { 
        Supplier::where("id", $id)->delete();
        $response['success'] = true;
        $response['message'] = "Data berhasil dihapus";
        return response()->json($response);
    }
}
