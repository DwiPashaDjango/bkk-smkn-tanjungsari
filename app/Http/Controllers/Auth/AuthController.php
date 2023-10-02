<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required|min:8'
        ]);

        $nisn = $request->nisn;
        $password = $request->password;

        $user = User::where('nisn', $nisn)->orWhere('email', $nisn)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                if (Auth::user()->roles === 'admin') {
                    return redirect('/dashboard');
                } else {
                    return redirect('/');
                }
            } else {
                return back()->with(['message' => 'Email Or Nisn Or Password Salah.']);
            }
        }
        return back()->with(['message' => 'Akun Tidak Terdaftar.']);
    }

    public function daftar(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nisn' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::create([
            'roles' => 'alumni',
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password)
        ]);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('auth.emails', ['token' => $token, 'user_id' => $user->id, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Verifikasi Akun BKK SMKN Tanjung Sari');
        });
        return redirect('/login')->with(['message' => 'Silahkan lakukan verifikasi pada akun email ' . $user->email]);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function verifyAccount($user_id, $token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $user_account = User::where('id', $user_id)->first();

        $message = 'Email tidak bisa di identifikasi.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = Carbon::now();
                $verifyUser->user->save();
                $message = "Berhasil verifikasi email, Selamat Datang " . $user_account->name . ' di BKK SMKN Tanjung Sari';
            } else {
                $message = "Email saudara sudah di verifikasi silahkan login.";
            }
        }
        Auth::login($user_account);
        return redirect('/')->with('message', $message);
    }
}
