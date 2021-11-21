<?php

namespace Modules\Apotek\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use Modules\Poliklinik\Entities\Poliklinik;
use RealRashid\SweetAlert\Facades\Alert;

class ApotekController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $perawatans = Perawatan::where('status', '>=', 2)->latest()->get();
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
        $perawatan = Perawatan::find($id)->first();
        $reseps = $perawatan->reseps;
        $status = ['Menunggu konfirmasi dokter', 'Menyiapkan obat', 'Pengambilan Obat', 'Selesai'];

        return view('apotek::admin.edit', compact(['perawatan', 'reseps', 'status',]))->with(['i' => 0]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $perawatan = Perawatan::find($id);
        // dd($request->all ());
        if ($request->status == 0) {
            foreach ($perawatan->reseps as $value) {
                $value->update(['status' => 0]);
            }
        }
        if ($request->status == 1) {
            foreach ($perawatan->reseps as $value) {
                $value->update(['status' => 1]);
            }
        }
        if ($request->status == 2) {
            foreach ($perawatan->reseps as $value) {
                $value->update(['status' => 2]);
            }
        }

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.apotek.edit', $id);
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
