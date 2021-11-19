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
use Modules\Poliklinik\Entities\Poliklinik;
use RealRashid\SweetAlert\Facades\Alert;


class RawatJalanController extends Controller
{

    public function index()
    {
        $perawatans = Perawatan::latest()->get();
        $polikliniks = Poliklinik::get();
        $pasiens = Pasien::latest()->get();
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pembayaran obat', 'Penyiapan obat', 'Pengambilan obat', 'Selesai'];
        return view('rawatjalan::admin.index', compact(['pasiens', 'perawatans', 'polikliniks',]))->with(['i' => 0]);
    }
    public function create()
    {
        return view('rawatjalan::create');
    }
    public function store(Request $request)
    {

        $time = Carbon::parse($request->tanggal);
        $poliklinik = Poliklinik::find($request->poliklinik_id);
        $perawatans = Perawatan::where('tanggal', $request->tanggal)->where('pelayanan', 'Rawat Jalan')->where('poliklinik_id', $request->poliklinik_id)->get();
        $request['kode'] = str_pad($perawatans->count() + 1, 3, '0', STR_PAD_LEFT) . $poliklinik->kode . '-' . $time->year . $time->month . str_pad($time->day, 2, '0', STR_PAD_LEFT) . '-' . 'RJ';
        $request['pelayanan'] = 'Rawat Jalan';
        $request['status'] = 0;

        $request->validate([
            'tanggal' => 'required',
            'kode' => 'required',
            'pasien_id' => 'required',
            'poliklinik_id' => 'required',
            'keluhan' => 'required',
            'pelayanan' => 'required',
            'status' => 'required',
        ]);

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
        $perawatan = Perawatan::where('id', $id)->first();
        $reseps = $perawatan->reseps;
        $obats = Obat::get();
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pembayaran obat', 'Penyiapan obat', 'Pemngambilan', 'Selesai'];

        return view('rawatjalan::admin.edit', compact(['perawatan', 'obats', 'reseps', 'status',]))->with(['i' => 0]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'cek' => 'required',
            'status' => 'required',
        ]);
        $perawatan = Perawatan::find($id);

        if ($request->cek == 1) {
            $perawatan->update([
                'status' => $request->status,
                'analisis' => $request->analisis,
            ]);
        }

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.rawat-jalan.edit', $id);
    }
    public function destroy($id)
    {
        //
    }
}
