<?php

namespace Modules\RawatJalan\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use Modules\Poliklinik\Entities\Poliklinik;
use RealRashid\SweetAlert\Facades\Alert;


class RawatJalanPasienController extends Controller
{
    public function index()
    {
        $perawatans = Perawatan::where('pasien_id', Auth::user()->id)->latest()->get();
        $polikliniks = Poliklinik::get();
        $pasien = Pasien::where('user_id', Auth::user()->id)->first();
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pembayaran obat', 'Penyiapan obat', 'Pengambilan obat', 'Selesai'];
        return view('rawatjalan::pasien.index', compact(['polikliniks', 'pasien', 'perawatans',]))->with(['i' => 0]);
    }

    public function create()
    {
        return view('rawatjalan::create');
    }

    public function store(Request $request)
    {
        $pasien = Pasien::where('user_id', Auth::user()->id)->first();
        $time = Carbon::parse($request->tanggal);
        $request['pasien_id'] = $pasien->id;
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
        return redirect()->route('pasien.rawat-jalan.index');
    }

    public function show($id)
    {
        $perawatan = Perawatan::where('kode', $id)->first();
        $reseps = $perawatan->reseps;
        $poliklinik = Poliklinik::pluck('name', 'id');
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pembayaran obat', 'Penyiapan obat', 'Pengambilan obat', 'Selesai'];

        return view('rawatjalan::pasien.show', compact(['perawatan', 'status', 'poliklinik', 'reseps']));
    }

    public function edit($id)
    {
        return view('rawatjalan::edit');
    }

    public function update(Request $request, $id)
    {
        $perawatan = Perawatan::where('kode', $id)->first();
        $perawatan->update($request->all());
        Alert::success('Success Info', 'Success Message');
        return redirect()->route('pasien.rawat-jalan.show', $id);
    }

    public function destroy($id)
    {
    }
}
