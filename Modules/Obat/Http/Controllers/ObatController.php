<?php

namespace Modules\Obat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dokter\Entities\Dokter;
use Modules\Obat\Entities\Obat;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $obats = Obat::latest()->get();
        return view('obat::admin.index', compact(['obats',]))->with(['i' => 0]);
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
        $request->validate([
            'kode'=>'required',
            'name'=>'required',
            'stok'=>'required',
            'manfaat'=>'required',
            'satuan'=>'required',
            'harga'=>'required',
        ]);

        Obat::updateOrCreate($request->except(['_token']));

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.obat.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('obat::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('obat::edit');
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
