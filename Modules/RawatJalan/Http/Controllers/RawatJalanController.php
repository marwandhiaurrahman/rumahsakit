<?php

namespace Modules\RawatJalan\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dokter\Entities\Dokter;
use Modules\Obat\Entities\Obat;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use RealRashid\SweetAlert\Facades\Alert;


class RawatJalanController extends Controller
{

    public function index()
    {
        $perawatans = Perawatan::latest()->get();
        $dokters = Dokter::latest()->get();
        $pasiens = Pasien::latest()->get();
        // dd($dokters);
        $spesialis = [
            'Umum' => 'Umum',
            'Penyakit Dalam' => 'Penyakit Dalam',
            'Anak' => 'Anak',
            'THT-KL' => 'THT-KL',
            'Gigi & Mulut' => 'Gigi & Mulut',
            'Mata' => 'Mata',
        ];
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pengambilan obat', 'Selesai'];
        return view('rawatjalan::admin.index', compact(['dokters',  'pasiens', 'perawatans', 'spesialis',]))->with(['i' => 0]);
    }
    public function create()
    {
        return view('rawatjalan::create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'tanggal' => 'required',
            'spesialis' => 'required',
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'keluhan' => 'required',
        ]);

        $request['pelayanan'] = 'Rawat Jalan';
        $time = Carbon::parse($request->tanggal);
        $perawatans = Perawatan::where('tanggal', $request->tanggal)->where('pelayanan', 'Rawat Jalan')->get();
        $request['kode'] = 'RJ' . $time->year . $time->month . str_pad($time->day, 2, '0', STR_PAD_LEFT) . '-' . str_pad($perawatans->count() + 1, 3, '0', STR_PAD_LEFT);
        $request['status'] = 0;

        Perawatan::updateOrCreate($request->except(['_token']));

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.rawat-jalan.index');
    }
    public function show($id)
    {
        $resep = Perawatan::find($id);
        $resep->delete();

        Alert::success('Success Info', 'Success Message');
        return redirect()->back();
    }
    public function edit($id)
    {
        $perawatan = Perawatan::where('kode', $id)->first();
        $obats = Obat::latest()->get();
        $spesialis = [
            'Umum' => 'Umum',
            'Penyakit Dalam' => 'Penyakit Dalam',
            'Anak' => 'Anak',
            'THT-KL' => 'THT-KL',
            'Gigi & Mulut' => 'Gigi & Mulut',
            'Mata' => 'Mata',
        ];
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pengambilan obat', 'Selesai'];
        $reseps = $perawatan->reseps;

        return view('rawatjalan::admin.edit', compact(['perawatan', 'reseps', 'status', 'obats', 'spesialis']))->with(['i' => 0]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'cek' => 'required',
        ]);

        $perawatan = Perawatan::where('kode', $id)->first();
        if ($request->cek == 1) {
            $perawatan->update($request->all());
        }

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.rawat-jalan.index');
    }
    public function destroy($id)
    {
        //
    }
}
