<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['is_verify_email'])->only('index', 'profileSekolah', 'updateProfile', 'resetPassword');
    }

    public function index()
    {
        return view('admin.settings');
    }

    public function profileSekolah(Request $request)
    {
        $request->validate([
            'nm_sekolah' => 'required|string',
            'email_sekolah' => 'required|string',
            'telp' => 'required',
            'alamat' => 'required'
        ]);

        $data = ProfileSekolah::where('id', $request->id)->first();
        if ($data) {
            $data->update([
                'nm_sekolah' => $request->nm_sekolah,
                'email_sekolah' => $request->email_sekolah,
                'telp' => $request->telp,
                'alamat' => $request->alamat
            ]);
        } else {
            ProfileSekolah::create([
                'nm_sekolah' => $request->nm_sekolah,
                'email_sekolah' => $request->email_sekolah,
                'telp' => $request->telp,
                'alamat' => $request->alamat
            ]);
        }
        return back()->with(['message' => 'Berhasil Mennyimpan Data Sekolah']);
    }

    public function getSekolah()
    {
        $data = ProfileSekolah::all();
        return response()->json($data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $data = User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return back()->with(['message' => 'Berhasil Mengubah Profile Saudara']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);

        $data = User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with(['message' => 'Berhasil Mengubah Password Silahkan Melakukan Login Ulang.']);
    }
}
