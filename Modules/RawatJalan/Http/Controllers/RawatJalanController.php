<?php

namespace Modules\RawatJalan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\Province;
use Modules\Dokter\Entities\Dokter;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;

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
        dd($pasiens);
        $spesialis = [
            'Umum' => 'Umum',
            'Penyakit Dalam' => 'Penyakit Dalam',
            'Anak' => 'Anak',
            'THT-KL' => 'THT-KL',
            'Gigi & Mulut' => 'Gigi & Mulut',
            'Mata' => 'Mata',
        ];
        return view('rawatjalan::admin.index', compact(['dokters', 'spesialis', 'agamas', 'kawin', 'provinces']))->with(['i' => 0]);
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
        //
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
