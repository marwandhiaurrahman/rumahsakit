<?php

namespace Modules\Dokter\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Modules\Dokter\Entities\Dokter;
use RealRashid\SweetAlert\Facades\Alert;

class DokterController extends Controller
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
        return view('dokter::admin.index', compact(['dokters', 'spesialis', 'agamas', 'kawin', 'provinces']))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dokter::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'nik' => 'required|unique:users,nik',
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'pekerjaan' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        $time = Carbon::now();
        $dokters = Dokter::all();
        $kode =  'D' . $time->year . $time->month . str_pad($dokters->count() + 1, 3, '0', STR_PAD_LEFT);

        $user = User::create($request->all());
        $user->assignRole('Pasien');
        Dokter::create([
            'user_id' => $user->id,
            'kode' => $kode,
            'status' => 1,
            'spesialis' => $request->pekerjaan,
        ]);
        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.dokter.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dokter::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $dokter = Dokter::find($id);
        $provinces = Province::pluck('name', 'code');
        $cities = City::where('province_code', $dokter->user->province_id)->pluck('name', 'code');
        $districts = District::where('city_code', $dokter->user->city_id)->pluck('name', 'code');
        $villages = Village::where('district_code', $dokter->user->district_id)->pluck('name', 'code');
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
        return view('dokter::admin.edit', compact(['dokter', 'provinces', 'cities', 'districts', 'villages', 'agamas', 'kawin']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $pasien = Dokter::find($id);
        $pasien->update($request->all());
        $pasien->user->update($request->all());

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.dokter.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $dokter = Dokter::find($id);
        if (empty($dokter->polikliniks)) {
            $dokter->delete();
            $dokter->user->delete();
            Alert::success('Success Info', 'Success Message');
        } else {
            Alert::error('Success Info', 'Success Message');
        }
        return redirect()->route('admin.dokter.index');
    }
}
