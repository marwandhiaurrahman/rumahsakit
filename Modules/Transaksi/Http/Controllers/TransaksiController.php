<?php

namespace Modules\Transaksi\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\Transaksi;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $transaksis = Transaksi::get();
        // dd($transaksis);
        return view('transaksi::admin.index', compact(['transaksis']))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transaksi::create');
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
        return view('transaksi::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $transaksi = Transaksi::find($id);
        $perawatan = $transaksi->perawatan;
        $status = ['Belum valid', 'Valid', 'Gagal'];
        $reseps = $perawatan->reseps;
        return view('transaksi::admin.edit', compact(['transaksi', 'reseps', 'status', 'perawatan']))->with(['i' => 0]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        // dd($request->all());
        $transaksi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.transaksi.edit', $id);
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
