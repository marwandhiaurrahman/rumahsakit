<?php

namespace Modules\RawatJalan\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dokter\Entities\Dokter;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use RealRashid\SweetAlert\Facades\Alert;


class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
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
        return view('rawatjalan::admin.index', compact(['dokters', 'pasiens', 'perawatans', 'spesialis',]))->with(['i' => 0]);
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

        Perawatan::create($request->all());

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.rawat-jalan.index');
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
        $perawatan = Perawatan::where('kode', $id)->first();
        // dd($perawatan);
        $spesialis = [
            'Umum' => 'Umum',
            'Penyakit Dalam' => 'Penyakit Dalam',
            'Anak' => 'Anak',
            'THT-KL' => 'THT-KL',
            'Gigi & Mulut' => 'Gigi & Mulut',
            'Mata' => 'Mata',
        ];
        return view('rawatjalan::admin.edit', compact(['perawatan', 'spesialis']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
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
