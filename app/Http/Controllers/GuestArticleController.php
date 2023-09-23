<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;

class GuestArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $loker = Loker::with('author')
                ->where('nm_pt', 'like', "%" . $search . "%")
                ->orWhere('lokasi', 'like', "%" . $search . "%")
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate(6);
        } else {
            $loker = Loker::with('author')
                ->where('status', 1)->orderBy('id', 'desc')->paginate(6);
        }
        return view('guest_article', compact('loker'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $nm_pt = $request->nm_pt;

        $loker = Loker::with('author')->where('id', $id)->where('nm_pt', $nm_pt)->first();
        $loker_all = Loker::with('author')->where('status', 1)->orderBy('id', 'desc')->paginate(6);
        return view('guest_show_article', compact('loker', 'loker_all'));
    }
}
