<?php

namespace Modules\Poliklinik\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\Province;
use Modules\Dokter\Entities\Dokter;
use Modules\Poliklinik\Entities\Poliklinik;
use RealRashid\SweetAlert\Facades\Alert;


class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $dokters = Dokter::all();
        $polikliniks = Poliklinik::latest()->get();

        return view('poliklinik::admin.index', compact(['dokters', 'polikliniks', ]))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('poliklinik::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'name' => 'required',
            'dokter_id' => 'required',
        ]);
        $request['status'] = 1;
        Poliklinik::updateOrCreate($request->except(['_token']));

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.poliklinik.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('poliklinik::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('poliklinik::edit');
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
