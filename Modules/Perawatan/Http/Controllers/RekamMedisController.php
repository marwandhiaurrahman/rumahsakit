<?php

namespace Modules\Perawatan\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\Province;
use Modules\Pasien\Entities\Pasien;
use Modules\Perawatan\Entities\Perawatan;
use Modules\Poliklinik\Entities\Poliklinik;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $pasiens = Pasien::latest()->get();
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
        return view('perawatan::rekammedis.index', compact(['pasiens', 'agamas', 'kawin', 'provinces']))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('perawatan::create');
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
        $pasien = Pasien::find($id);
        // dd($pasien->user->name);
        $perawatans = $pasien->perawatans;
        $polikliniks = Poliklinik::get();
        $status = ['Menunggu antrian', 'Pengecekan oleh dokter', 'Pembayaran obat', 'Penyiapan obat', 'Pengambilan obat', 'Selesai'];
        return view('perawatan::rekammedis.show', compact(['polikliniks', 'pasien', 'perawatans',]))->with(['i' => 0]);
        // return view('perawatan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('perawatan::edit');
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
