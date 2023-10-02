<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_verify_email']);
    }

    public function index()
    {
        $users_admin = User::where('roles', 'admin')->count();
        $users_alumni = User::where('roles', 'alumni')->count();
        $loker_count = Loker::count();
        return view('admin.dashboard', [
            'users_admin' => $users_admin,
            'users_alumni' => $users_alumni,
            'loker_count' => $loker_count
        ]);
    }
}
