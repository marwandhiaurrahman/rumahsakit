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
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $perawatans = Perawatan::latest()->get();
        $poliklinik = Poliklinik::get();
        $pasien = Pasien::where('user_id', Auth::user()->id)->first();
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pengambilan obat', 'Selesai'];
        return view('rawatjalan::pasien.index', compact(['poliklinik', 'pasien', 'perawatans',]))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('rawatjalan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pasien = Pasien::where('user_id', Auth::user()->id)->first();
        $time = Carbon::parse($request->tanggal);
        $request['pasien_id'] = $pasien->id;
        $poliklinik = Poliklinik::find($request->poliklinik_id);
        $perawatans = Perawatan::where('tanggal', $request->tanggal)->where('pelayanan', 'Rawat Jalan')->where('poliklinik_id', $request->poliklinik_id)->get();
        $request['kode'] = 'RJ-' . $poliklinik->kode . '-' . $time->year . $time->month . str_pad($time->day, 2, '0', STR_PAD_LEFT) . '-' . str_pad($perawatans->count() + 1, 3, '0', STR_PAD_LEFT);
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('rawatjalan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('rawatjalan::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
