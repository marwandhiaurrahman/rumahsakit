<?php

namespace Modules\Obat\Http\Controllers;

use Darryldecode\Cart\Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Obat\Entities\Obat;
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

        $cart = \Cart::session($request->kode)->add(array(
            'id' => $obat->id,
            'name' => $obat->name,
            'price' => $obat->harga,
            'quantity' => $request->stok,
            'attributes' => [
                'dosis'=>$request->dosis,
                'keterangan'=>$request->keterangan,
                'status'=>0,
            ],
        ));
        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.rawat-jalan.edit',$request->kode);
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
