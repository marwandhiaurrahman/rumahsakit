<?php

namespace Modules\Obat\Http\Controllers;

use Darryldecode\Cart\Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Obat\Entities\Obat;
use Modules\Obat\Entities\Resep;
use Modules\Perawatan\Entities\Perawatan;
use Modules\Transaksi\Entities\Transaksi;
use RealRashid\SweetAlert\Facades\Alert;


class ResepObatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('obat::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('obat::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $obat = Obat::find($request->obat_id);
        if ($obat->stok - $request->stok >= 0) {
            $perawatan = Perawatan::find($request->perawatan_id);
            $perawatan->update($request->all());

            $request['harga'] = $obat->harga * $request->stok;
            $request['name'] = $obat->name;
            $request['status'] = 0;
            Resep::updateOrCreate($request->except(['_token']));

            Alert::success('Success Info', 'Success Message');
            return redirect()->route('admin.rawat-jalan.edit', $request->perawatan_id);
        } else {
            $perawatan = Perawatan::find($request->perawatan_id);
            $perawatan->update($request->all());
            Alert::error('Error Info', 'Error Message');
            return redirect()->route('admin.rawat-jalan.edit', $request->perawatan_id);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $resep = Resep::find($id);
        $resep->delete();

        Alert::success('Success Info', 'Success Message');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $perawatan = Perawatan::find($id);
        foreach ($perawatan->reseps as $value) {
            $value->update(['status' => 1]);
        }
        $perawatan->update(['status' => 2]);
        $request['kode'] = $perawatan->kode;
        $request['perawatan_id'] = $perawatan->id;
        $request['tipe'] = 'Debit';
        $request['status'] = 0;
        $request['harga'] = $perawatan->reseps->sum('harga');
        try {
            Transaksi::updateOrCreate($request->except(['cek']));

        } catch (\Throwable $th) {
            $transaksi = Transaksi::where('kode', $perawatan->kode)->first();
            $transaksi->update($request->all());

        }

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.rawat-jalan.edit', $id);
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
    }
}
