<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengajar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PengajarResource;
use Illuminate\Support\Facades\Validator;

class PengajarController extends Controller
{
    //
    public function index(){
        $pengajars = Pengajar::latest()->paginate(10);

        //Tampil data
        return new PengajarResource(true, 'List Data Guru', $pengajars);
    }

    public function store(Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), [
            'nip'     => 'required',
            'nama'     => 'required',
            'mata_pelajaran'   => 'required',
        ]);

        //cek jika validasi fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create data
        $pengajars = Pengajar::create([
            'nip'     => $request->nip,
            'nama'     => $request->nama,
            'mata_pelajaran'   => $request->mata_pelajaran,
        ]);

        //return response
        return new PengajarResource(true, 'Data Berhasil Ditambahkan!', $pengajars);
    }

    public function show(Pengajar $pengajar)
    {
        //panggil data berdasarkan id
        return new PengajarResource(true, 'Data Ditemukan!', $pengajar);
    }

    public function update(Request $request, Pengajar $pengajar)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nip'     => 'required',
            'nama'     => 'required',
            'mata_pelajaran'   => 'required',           
        ]);

        //cek jika validasi fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update 
        $pengajar->update([
            'nip'     => $request->nip,
            'nama'     => $request->nama,
            'mata_pelajaran'   => $request->mata_pelajaran,
        ]);
        
        return new PengajarResource(true, 'Data Berhasil Diubah!', $pengajar);
    }

    public function destroy(Pengajar $pengajar)
    {
        //delete
        $pengajar->delete();
        
        return new PengajarResource(true, 'Data Berhasil Dihapus!', null);
    }
}
