<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_verify_email']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $lokers = Loker::with('author')
                ->where('nm_pt', 'like', "%" . $search . "%")
                ->orWhere('lokasi', 'like', "%" . $search . "%")
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $lokers = Loker::with('author')->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.article.article', compact('lokers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048',
            'nm_pt' => 'required|string',
            'lokasi' => 'required',
            'kantor' => 'required',
            'description' => 'required',
            'status' => 'required'
        ], [
            'nm_pt.required' => 'Nama Perusahaan Tidak Boleh Kosong.',
            'lokasi.required' => 'Lokasi Atau Kota Tempat Bekerja Tidak Boleh Kosong.',
            'kantor.required' => 'Penempatan Kerja (Kantor Utama / Cabang) Tidak Boleh Kosong.',
            'status.required' => 'Pilih Salah Satu Status Published / Draft.'
        ]);

        $file = $request->file('thumbnail');
        $fileName = date('dmy H:i:s') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/article/'), $fileName);
        $path = '/img/article/' . $fileName;

        $article = Loker::create([
            'users_id' => Auth::user()->id,
            'nm_pt' => $request->nm_pt,
            'kantor' => $request->kantor,
            'lokasi' => $request->lokasi,
            'description' => $request->description,
            'thumbnail' => $fileName,
            'status' => $request->status
        ]);

        if ($request->status == 1) {
            $user = User::where('roles', '=', 'alumni')->get();
            Notification::send($user, new NewArticleNotification($article));
        }
        return redirect()->route('admin.lokers')->with(['message' => 'Berhasil Membuat Informasi Tentang Lowongan Pekerjaan Di ' . $article->nm_pt]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $loker = Loker::with('author')->where('id', $request->id)->where('nm_pt', $request->nm_pt)->first();
        return view('admin.article.edit', compact('loker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'thumbnail' => 'mimes:png,jpg,jpeg|max:2048',
            'nm_pt' => 'required|string',
            'lokasi' => 'required',
            'kantor' => 'required',
            'description' => 'required',
            'status' => 'required'
        ], [
            'nm_pt.required' => 'Nama Perusahaan Tidak Boleh Kosong.',
            'lokasi.required' => 'Lokasi Atau Kota Tempat Bekerja Tidak Boleh Kosong.',
            'kantor.required' => 'Penempatan Kerja (Kantor Utama / Cabang) Tidak Boleh Kosong.',
            'status.required' => 'Pilih Salah Satu Status Published / Draft.'
        ]);

        $article = Loker::find($id);

        $path = public_path('img/article/' . $article->thumbnail);

        if ($request->file('thumbnail') && file_exists($path)) {
            $file = $request->file('thumbnail');
            $fileName = date('dmy H:i:s') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/article/'), $fileName);

            unlink($path);

            $article->update([
                'nm_pt' => $request->nm_pt,
                'kantor' => $request->kantor,
                'lokasi' => $request->lokasi,
                'description' => $request->description,
                'thumbnail' => $fileName,
                'status' => $request->status
            ]);
        } else {
            $article->update([
                'nm_pt' => $request->nm_pt,
                'kantor' => $request->kantor,
                'lokasi' => $request->lokasi,
                'description' => $request->description,
                'thumbnail' => $article->thumbnail,
                'status' => $request->status
            ]);
        }
        if ($request->status == 1) {
            $user = User::where('roles', '=', 'alumni')->get();
            Notification::send($user, new NewArticleNotification($article));
        }
        return redirect()->route('admin.lokers')->with(['message' => 'Berhasil Merubah Informasi Tentang Lowongan Pekerjaan Di ' . $article->nm_pt]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Loker::find($id);

        $path = public_path('img/article/' . $article->thumbnail);
        if (file_exists($path)) {
            unlink($path);
        }
        $article->delete();
        return redirect()->route('admin.lokers')->with(['message' => 'Berhasil Menghapus Informasi Tentang Lowongan Pekerjaan Di ' . $article->nm_pt]);
    }
}
