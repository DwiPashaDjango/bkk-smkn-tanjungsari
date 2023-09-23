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
        $avatar = public_path('img/avatar/alumni/' . $user->user_profile->avatar);

        $left_logo = public_path('img/logo.png');
        $rigth_logo = public_path('img/logo.png');

        $pdf = Pdf::loadView('guest_pdf_profile', ['user' => $user, 'avatar' => $avatar, 'left_logo' => $left_logo, 'right_logo' => $rigth_logo]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->download($user->name . '.pdf');
    }
}
