<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\ImportUsers;
use App\Models\User;
use App\Models\UserProfile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $data = User::with('user_profile')->find($id);
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
        $data = User::with('user_profile')->find($id);
        return view('admin.edit_alumni', compact('data'));
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
            'jurusan' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'thn_lulus' => 'required',
            'sts_karir' => 'required',
            'telp' => 'required'
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

        $user = User::with('user_profile')->find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'jurusan' => $request->jurusan
        ]);

        $user_profile = UserProfile::where('users_id', $id)->first();

        if ($user_profile) {
            $user_profile->update([
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
        $user = UserProfile::with('user')->where('thn_lulus', $thn_lulus)->get();
        $pdf = Pdf::loadView('admin.pdf.export', ['user' => $user, 'tahun' => $tahun]);
        return $pdf->download('data-alumni-angkatan-' . $tahun . '.pdf');
    }

    public function importAlumni(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $fileName = rand() . '.' . $file->getClientOriginalExtension();

        Excel::import(new ImportUsers, $file->storeAs('/import_file/' . $fileName));
        return redirect()->route('alumni')->with(['message' => 'Berhasil Mengimport Data Alumni']);
    }

    public function generatePdfUser($id)
    {
        $user = User::with('user_profile')->where('id', $id)->first();
        $left_logo = public_path('img/logo.png');
        $avatar = public_path('img/avatar/alumni/' . $user->user_profile->avatar);
        $pdf = Pdf::loadView('admin.pdf.export_user_by_id', ['user' => $user, 'left_logo' => $left_logo, 'avatar' => $avatar]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream($user->name . '.pdf');
    }

    public function exportUser()
    {
        return Excel::download(new UsersExport, 'data-alumni-' . date('Y') . '.xlsx');
    }
}
