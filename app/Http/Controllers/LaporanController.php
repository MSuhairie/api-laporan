<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LaporanResource;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::join('users', 'laporans.author_id', '=', 'users.id')
                    ->select('laporans.*', 'users.id as user_id', 'users.username')
                    ->get();

        return LaporanResource::collection($laporans);
    }

    public function detail($id)
    {
        $laporan = Laporan::join('users', 'laporans.author_id', '=', 'users.id')
                   ->select('laporans.*', 'users.id as user_id', 'users.username')
                   ->find($id);

        if (!$laporan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return new LaporanResource($laporan);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'jenis' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'merk' => 'required',
            'biaya' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'foto1' => 'required',
            'foto_perbaikan1' => 'required',
            'kegiatan_perbaikan' => 'required',
            'pihak_terlibat' => 'required',
        ], [
            'type.required' => 'type wajib diisi !!',
            'jenis.required' => 'jenis wajib diisi !!',
            'tanggal.required' => 'tanggal wajib diisi !!',
            'waktu.required' => 'waktu wajib diisi !!',
            'lokasi.required' => 'lokasi wajib diisi !!',
            'merk.required' => 'merk wajib diisi !!',
            'biaya.required' => 'biaya wajib diisi !!',
            'status.required' => 'status wajib diisi !!',
            'deskripsi.required' => 'deskripsi wajib diisi !!',
            'foto1.required' => 'foto wajib diisi !!',
            'foto_perbaikan1.required' => 'foto_perbaikan wajib diisi !!',
            'kegiatan_perbaikan.required' => 'kegiatan_perbaikan wajib diisi !!',
            'pihak_terlibat.required' => 'pihak_terlibat wajib diisi !!',
        ]);

        $fileNameFoto = null;
        if ($request->foto1) {
           $foto = $request->foto1;
           $fileNameFoto = time().'.'.$foto->extension();
           $foto->move(public_path('assets/foto'), $fileNameFoto);
        }

        $fileNameFotoPerbaikan = null;
        if ($request->foto_perbaikan1) {
           $fotoPerbaikan = $request->foto_perbaikan1;
           $fileNameFotoPerbaikan = time().'.'.$fotoPerbaikan->extension();
           $fotoPerbaikan->move(public_path('assets/foto_perbaikan'), $fileNameFotoPerbaikan);
        }

        $request['foto'] = $fileNameFoto;
        $request['foto_perbaikan'] = $fileNameFotoPerbaikan;
        $request['author_id'] = Auth::user()->id;

        $laporans = Laporan::create($request->all());

        return response()->json([
            'status' => '200',
            'message' => 'Data Berhasil Disimpan'
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'jenis' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'merk' => 'required',
            'biaya' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'foto1' => 'required',
            'foto_perbaikan1' => 'required',
            'kegiatan_perbaikan' => 'required',
            'pihak_terlibat' => 'required',
        ], [
            'type.required' => 'type wajib diisi !!',
            'jenis.required' => 'jenis wajib diisi !!',
            'tanggal.required' => 'tanggal wajib diisi !!',
            'waktu.required' => 'waktu wajib diisi !!',
            'lokasi.required' => 'lokasi wajib diisi !!',
            'merk.required' => 'merk wajib diisi !!',
            'biaya.required' => 'biaya wajib diisi !!',
            'status.required' => 'status wajib diisi !!',
            'deskripsi.required' => 'deskripsi wajib diisi !!',
            'foto1.required' => 'foto wajib diisi !!',
            'foto_perbaikan1.required' => 'foto_perbaikan wajib diisi !!',
            'kegiatan_perbaikan.required' => 'kegiatan_perbaikan wajib diisi !!',
            'pihak_terlibat.required' => 'pihak_terlibat wajib diisi !!',
        ]);

        if (!empty($request->foto1) && !empty($request->foto_perbaikan1)) {

            $foto = $request->foto1;
            $fileNameFoto = time().'.'.$foto->extension();
            $foto->move(public_path('assets/foto'), $fileNameFoto);

            $fotoPerbaikan = $request->foto_perbaikan1;
            $fileNameFotoPerbaikan = time().'.'.$fotoPerbaikan->extension();
            $fotoPerbaikan->move(public_path('assets/foto_perbaikan'), $fileNameFotoPerbaikan);

            $request['foto'] = $fileNameFoto;
            $request['foto_perbaikan'] = $fileNameFotoPerbaikan;

            $laporans = Laporan::find($id);
            $laporans->update($request->all());

        }else{

            $laporans = Laporan::find($id);
            $laporans->update($request->all());

        }

        return response()->json([
            'status' => '200',
            'message' => 'Data Berhasil Diedit'
        ], 200);
    }

    public function hapus($id)
    {
        $laporans = Laporan::find($id);

        if (!$laporans) {
            return response()->json(['message' => 'Data dihapus tidak ada'], 404);
        }else{
            if (!empty($laporans->foto) && !empty($laporans->foto_perbaikan)) {
                unlink(public_path('assets/foto') . '/' . $laporans->foto);
                unlink(public_path('assets/foto_perbaikan') . '/' . $laporans->foto_perbaikan);
                $laporans->delete();
            }else{
                $laporans->delete();
            }
            return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
        }


    }
}
