<?php

namespace Modules\Pasien\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Modules\Pasien\Entities\Pasien;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
{
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
        return view('pasien::admin.index', compact(['pasiens', 'agamas', 'kawin', 'provinces']))->with(['i' => 0]);
    }

    public function create()
    {
        return view('pasien::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        $time = Carbon::now();
        $pasiens = Pasien::all();
        $kode =  $time->year . $time->month . str_pad($time->day, 2, '0', STR_PAD_LEFT) . str_pad($pasiens->count() + 1, 3, '0', STR_PAD_LEFT);
        $request['password'] =  Hash::make($request->password);

        $user = User::create($request->all());
        $user->assignRole('Pasien');
        Pasien::create([
            'user_id' => $user->id,
            'kode' => $kode,
            'status' => 0
        ]);
        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.pasien.index');
    }

    public function show($id)
    {
        return view('pasien::show');
    }


    public function edit($id)
    {
        $pasien = Pasien::find($id);
        $provinces = Province::pluck('name', 'code');
        $cities = City::where('province_code', $pasien->user->province_id)->pluck('name', 'code');
        $districts = District::where('city_code', $pasien->user->city_id)->pluck('name', 'code');
        $villages = Village::where('district_code', $pasien->user->district_id)->pluck('name', 'code');
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
        // dd($pasien);
        return view('pasien::admin.edit', compact(['pasien', 'provinces', 'cities', 'districts', 'villages', 'agamas', 'kawin']));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);
        $pasien->update($request->all());
        $pasien->user->update($request->all());

        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.pasien.index');
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        if (empty($pasien->perawatans)) {
            $pasien->delete();
            Alert::success('Success Info', 'Success Message');
        } else {
            Alert::error('Success Info', 'Success Message');
        }
        return redirect()->route('admin.pasien.index');
    }
}
