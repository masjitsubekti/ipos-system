<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index(Request $request)
    {   
        $data = [];
        $q = $request->get('q');
        return view('satuan.index', compact('data', 'q'));
    }

    public function fetch_data(Request $request)
    {
        $limit = $request->get('limit');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        $q = $request->get('q');
        $q = str_replace(" ", "%", $q);

        $data = DB::table('m_satuan')
                    ->where('nama', 'like', '%'.$q.'%')
                    ->orderBy($sortBy, $sortType)
                    ->paginate($limit);
                    
        $data->appends($request->all());
        return view('satuan.list_data', compact('data'));
    }

    public function load_modal(Request $request)
    {
      $id = $request->id;
      if ($id != "") {
        $data['mode'] = "UPDATE";
        $data['data'] = Satuan::find($id);	
      } else {
        $data['mode'] = "ADD";
      }
      return view('satuan.form_modal', $data);
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
            'nama.required' => 'Satuan wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
              $response['success'] = false;
              $response['message'] = "Harap lengkapi isian dengan benar";
              return response()->json($response);
          }
          
          // Handle Save
          $data = new Satuan();
          $data->nama = $request->nama;
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
            'nama' => $request->input('nama'),
          ];
          $rules = [
            'nama' => 'required',
          ];
          $messages = [
            'nama.required' => 'Satuan wajib diisi',
          ];

          $validator = Validator::make($input, $rules, $messages);
          if($validator->fails()){
              $response['success'] = false;
              $response['message'] = "Harap lengkapi isian dengan benar";
              return response()->json($response);
          }

          $id = $request->id;
          $data = Satuan::find($id)
          ->update([
            'nama' => $request->nama
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
        Satuan::where("id", $id)->delete();
        $response['success'] = true;
        $response['message'] = "Data berhasil dihapus";
        return response()->json($response);
    }
}
