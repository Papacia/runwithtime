<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use illuminate\support\Facades\Auth;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    public function index () {
        return Kegiatan::where([
            ['user_id', '=', Auth('api')->user()->id],
            ['delstatus', '=', 1]
        ])->orderBy('id','desc')->get();


    }


    public function simpanKegiatan(Request $request){
        $tglFormat = Carbon::createFromFormat('d/m/Y', $request->tgl)->format('Y-m-d');
        return Kegiatan::create([
            'judul' => $request['judul'],
            'tgl' => $tglFormat,
            'isi' => $request['isi'],
            'user_id' => Auth('api')->user()->id,
            'delstatus' => 1,
        ]);
    }

    public function hapus($id) {
        $hapus = Kegiatan::findOrFail($id);
        // return $hapus->delete();
        $data = [
            'delstatus' => 0,
        ];
        return $hapus->update($data);
    }

    public function ubah(Request $request, $id){
        $ubah = Kegiatan::findOrFail($id);
        $tglFormat = Carbon::createFromFormat('d/m/Y', $request->tgl)->format('Y-m-d');
        $data = [
            'judul' => $request['judul'],
            'tgl' => $tglFormat,
            'isi' => $request['isi'],
        ];
        return $ubah->update($data);
    }
}
