<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        $user = User::with('user_profile', 'user_profile.jurusan')
            ->where('id', $users_id)
            ->where('name', $users_name)
            ->first();
        $pdf = Pdf::loadView('guest_pdf_profile', ['user' => $user]);
        return $pdf->download($user->name . '.pdf');
    }
}
