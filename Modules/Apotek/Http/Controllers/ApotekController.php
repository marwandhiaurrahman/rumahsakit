<?php

namespace Modules\Apotek\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use Modules\Poliklinik\Entities\Poliklinik;

class ApotekController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $perawatans = Perawatan::where('status', '>=',2)->latest()->get();
        $polikliniks = Poliklinik::get();
        // $pasien = Pasien::where('user_id', Auth::user()->id)->first();
        // dd($perawatans->first()->reseps->count());
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pengambilan obat', 'Selesai'];
        return view('apotek::admin.index', compact(['polikliniks', 'perawatans',]))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('apotek::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('apotek::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $perawatan = Perawatan::where('kode', $id)->first();
        $reseps = $perawatan->reseps;
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pembayaran obat', 'Penyiapan obat', 'Pemngambilan', 'Selesai'];

        return view('rawatjalan::admin.edit', compact(['perawatan', 'reseps', 'status', ]))->with(['i' => 0]);
        // return view('apotek::edit');
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
