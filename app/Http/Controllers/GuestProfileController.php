<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_verify_email']);
    }

    public function index()
    {
        return view('guest_profile');
    }

    public function getProfilePdf(Request $request)
    {
        $users_id = $request->query('id');
        $users_name = $request->query('name');

        $user = User::with('user_profile')
            ->where('id', $users_id)
            ->where('name', $users_name)
            ->first();
        $avatar = public_path('img/avatar/alumni/' . $user->user_profile->avatar);

        $left_logo = public_path('img/logo.png');
        $rigth_logo = public_path('img/logo.png');

        $pdf = Pdf::loadView('guest_pdf_profile', ['user' => $user, 'avatar' => $avatar, 'left_logo' => $left_logo, 'right_logo' => $rigth_logo]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->download($user->name . '.pdf');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'thn_lulus' => 'required',
            'sts_karir' => 'required',
            'telp' => 'required',
            'alamat' => 'required'
        ], [
            'name.required' => 'Nama Lengkap Tidak Boleh Kosong.',
            'email.required' => 'Email Tidak Boleh Kosong.',
            'nisn.required' => 'Nisn Tidak Boleh Kosong.',
            'jurusan.required' => 'Pilih Jurusan Saat Saudara Masih Sekolah.',
            'tmp_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong.',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong.',
            'thn_lulus.required' => 'Pilih Tahun Kelulusan Saudara.',
            'sts_karir.required' => 'Pilih Jenjang Karir Yang Sedang Di Tempuh.',
            'telp.required' => 'Masukan No Telephone Saudara.'
        ]);

        $data = User::with('user_profile')->where('id', Auth::user()->id)->first();
        $user_profile = UserProfile::where('users_id', Auth::user()->id)->first();

        $path = public_path('/img/avatar/alumni/' . $user_profile->avatar);
        if ($request->file('avatar') && file_exists($request->file('avatar'))) {
            $file = $request->file('avatar');
            $fileName = date('dmy H:i:s') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/avatar/alumni/'), $fileName);
            unlink($path);

            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'jurusan' => $request->jurusan
            ]);
            $user_profile->update([
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'thn_lulus' => $request->thn_lulus,
                'sts_karir' => $request->sts_karir,
                'perusahaan' => $request->perusahaan,
                'penghasilan' => $request->penghasilan,
                'universitas' => $request->universitas,
                'telp' => $request->telp,
                'avatar' => $fileName,
                'alamat' => $request->alamat
            ]);
        } else {
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'jurusan' => $request->jurusan
            ]);
            $user_profile->update([
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'thn_lulus' => $request->thn_lulus,
                'sts_karir' => $request->sts_karir,
                'perusahaan' => $request->perusahaan,
                'penghasilan' => $request->penghasilan,
                'universitas' => $request->universitas,
                'telp' => $request->telp,
                'avatar' => $data->user_profile->avatar,
                'alamat' => $request->alamat
            ]);
        }
        return back()->with(['message' => 'Berhasil Mengupdate Profile']);
    }
}
