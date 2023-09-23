<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Loker;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('save_user_profile');
    }

    public function index()
    {
        $jurusan = Jurusan::all();
        $loker_all = Loker::with('author')->where('status', 1)->orderBy('id', 'desc')->paginate(6);
        return view('welcome', compact('jurusan', 'loker_all'));
    }

    public function save_user_profile(Request $request)
    {
        $request->validate([
            'jurusans_id' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'thn_lulus' => 'required',
            'sts_karir' => 'required',
            'telp' => 'required',
            'avatar' => 'required|mimes:jpg,jpeg,png|max:2048'
        ], [
            'jurusans_id.required' => 'Pilih Jurusan Saat Saudara Masih Sekolah.',
            'tmp_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong.',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong.',
            'thn_lulus.required' => 'Pilih Tahun Kelulusan Saudara.',
            'sts_karir.required' => 'Pilih Jenjang Karir Yang Sedang Di Tempuh.',
            'telp.required' => 'Masukan No Telephone Saudara.',
            'avatar.required' => 'Silahkan Masukan Foto Saudara Dengan Ukuran 2 x 3 Atau 4 x 6',
            'avatar.mimes' => 'Foto Hanya Boleh Berformat jpg,jpeg dan png',
            'avatar.max' => 'Ukuran Foto Maksimal 2 mb'
        ]);

        $file = $request->file('avatar');
        $fileName = date('dmy H:i:s') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/avatar/alumni/'), $fileName);
        $path = '/avatar/alumni/' . $fileName;

        UserProfile::create([
            'users_id' => Auth::user()->id,
            'jurusans_id' => $request->jurusans_id,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'thn_lulus' => $request->thn_lulus,
            'sts_karir' => $request->sts_karir,
            'penghasilan' => $request->penghasilan,
            'universitas' => $request->universitas,
            'telp' => $request->telp,
            'avatar' => $fileName
        ]);

        return redirect('/')->with(['message' => 'Berhasil Melengkapi Data Biodata .']);
    }

    public function getChartByYear(Request $request)
    {
        $year = $request->query('year');

        $users = UserProfile::whereIn('sts_karir', ['Bekerja', 'Kuliah', 'Belum'])
            ->where('thn_lulus', $year)
            ->groupBy('sts_karir')
            ->selectRaw('sts_karir, count(*) as count')
            ->pluck('count', 'sts_karir')
            ->toArray();

        $labels = array_keys($users);
        $values = array_values($users);

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
