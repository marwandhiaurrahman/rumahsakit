<?php

namespace Modules\Poliklinik\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\Province;
use Modules\Dokter\Entities\Dokter;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $dokters = Dokter::latest()->get();
        $provinces = Province::pluck('name', 'code');
        $agamas = [
            'Islam' => 'Islam',
            'Protestan' => 'Protestan',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Budha' => 'Budha',
            'Konghucu' => 'Konghucu',
        ];
        $kawin = [
            'Belum Kawin' => 'Belum Kawin',
            'Kawin' => 'Kawin',
            'Cerai Hidup' => 'Cerai Hidup',
            'Cerai Mati' => 'Cerai Mati',
        ];
        $spesialis = [
            'Umum' => 'Umum',
            'Penyakit Dalam' => 'Penyakit Dalam',
            'Anak' => 'Anak',
            'THT-KL' => 'THT-KL',
            'Gigi & Mulut' => 'Gigi & Mulut',
            'Mata' => 'Mata',
        ];
        return view('poliklinik::admin.index', compact(['dokters', 'spesialis', 'agamas', 'kawin', 'provinces']))->with(['i' => 0]);
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
        //
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
