<?php

namespace Modules\Pasien\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\Province;
use Modules\Pasien\Entities\Pasien;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
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
        return view('pasien::admin.index', compact(['pasiens', 'agamas', 'kawin', 'provinces']))->with(['i' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pasien::create');
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
        $kodetransaksi =  $time->year . $time->month . str_pad($time->day, 2, '0', STR_PAD_LEFT) . str_pad($pasiens->count() + 1, 3, '0', STR_PAD_LEFT);

        $user = User::create($request->all());
        Pasien::create([
            'user_id' => $user->id,
            'kode' => $kodetransaksi,
            'status' => 0
        ]);
        Alert::success('Success Info', 'Success Message');
        return redirect()->route('admin.pasien.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pasien::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pasien::edit');
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
