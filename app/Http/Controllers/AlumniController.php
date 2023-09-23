<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\User;
use App\Models\UserProfile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_verify_email']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('user_profile')->where('roles', 'alumni')->orderBy('name', 'asc')->get();
        return view('admin.data_alumni', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::with('user_profile', 'user_profile.jurusan')->find($id);
        if (!$data) {
            return abort(404);
        }
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jurusan = Jurusan::all();
        $data = User::with('user_profile', 'user_profile.jurusan')->find($id);
        return view('admin.edit_alumni', compact('data', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'nisn' => 'required',
            'jurusans_id' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'thn_lulus' => 'required',
            'sts_karir' => 'required',
            'telp' => 'required'
        ], [
            'name.required' => 'Nama Lengkap Tidak Boleh Kosong.',
            'email.required' => 'Email Tidak Boleh Kosong.',
            'nisn.required' => 'Nisn Tidak Boleh Kosong.',
            'jurusans_id.required' => 'Pilih Jurusan Saat Saudara Masih Sekolah.',
            'tmp_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong.',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong.',
            'thn_lulus.required' => 'Pilih Tahun Kelulusan Saudara.',
            'sts_karir.required' => 'Pilih Jenjang Karir Yang Sedang Di Tempuh.',
            'telp.required' => 'Masukan No Telephone Saudara.'
        ]);

        $user = User::with('user_profile')->find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
        ]);

        $user_profile = UserProfile::where('users_id', $id)->first();

        if ($user_profile) {
            $user_profile->update([
                'jurusans_id' => $request->jurusans_id,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'thn_lulus' => $request->thn_lulus,
                'sts_karir' => $request->sts_karir,
                'penghasilan' => $request->penghasilan,
                'universitas' => $request->universitas,
                'telp' => $request->telp
            ]);
        } else {
            UserProfile::create([
                'users_id' => $request->users_id,
                'jurusans_id' => $request->jurusans_id,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'thn_lulus' => $request->thn_lulus,
                'sts_karir' => $request->sts_karir,
                'penghasilan' => $request->penghasilan,
                'universitas' => $request->universitas,
                'telp' => $request->telp
            ]);
        }

        return redirect('/data-alumni')->with(['message' => 'Berhasil Memperbarui Data ' . $user->name]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::with('user_profile')->find($id);
        $user->user_profile()->delete();
        $user->delete();
        return response()->json(['success' => 'Berhasil Menghapus Data Alumni.']);
    }

    public function exportPdf($thn_lulus)
    {
        $tahun = $thn_lulus;
        $user = UserProfile::with('user', 'jurusan')->where('thn_lulus', $thn_lulus)->get();
        $pdf = Pdf::loadView('admin.pdf.export', ['user' => $user, 'tahun' => $tahun]);
        return $pdf->download('data-alumni-angkatan-' . $tahun . '.pdf');
    }
}
