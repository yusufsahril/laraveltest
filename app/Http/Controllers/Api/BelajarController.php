<?php

namespace App\Http\Controllers\Api;

use App\Models\Belajar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BelajarResource;
use Illuminate\Support\Facades\Validator;

class BelajarController extends Controller
{
    public function index()
    {
        //get belajar
        $belajars = Belajar::with('datajoin')->get();

        return new BelajarResource(true, 'Data Pelajar', $belajars);
    }

    public function store(Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), [
            'kd_pengajar'     => 'required',
            'nama'     => 'required',
            'email'   => 'required',
            'alamat'     => 'required',
        ]);

        //cek jika validasi fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create data
        $belajars = Belajar::create([
            'kd_pengajar'     => $request->kd_pengajar,
            'nama'     => $request->nama,
            'email'   => $request->email,
            'alamat'     => $request->alamat,
        ]);

        //return response
        return new BelajarResource(true, 'Data Berhasil Ditambahkan!', $belajars);
    }

    public function show($belajar)
    {
        //panggil data berdasarkan id
        $belajars = Belajar::with('datajoin')->where('id', $belajar)->first();
        return new BelajarResource(true, 'Data Ditemukan!', $belajars);
    }

    public function update(Request $request, Belajar $belajar)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kd_pengajar'     => 'required',
            'nama'     => 'required',
            'email'   => 'required',
            'alamat'     => 'required',
           
        ]);

        //cek jika validasi fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update 
        $belajar->update([
            'kd_pengajar'     => $request->kd_pengajar,
            'nama'     => $request->nama,
            'email'   => $request->email,
            'alamat'     => $request->alamat,
        ]);
        
        return new BelajarResource(true, 'Data Berhasil Diubah!', $belajar);
    }

    public function destroy(Belajar $belajar)
    {
        //delete
        $belajar->delete();
        
        return new BelajarResource(true, 'Data Berhasil Dihapus!', null);
    }

    public function join($id)
    {
        return Belajar::join('belajars','belajars.kd_pengajar','=','pengajars.id')
        ->get(['belajars.nama, belajars.email, belajars.alamat, pengajars.nama, pengajars.mata_pelajaran']);
    }

}
