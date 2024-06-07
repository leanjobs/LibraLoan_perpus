<?php

namespace App\Http\Controllers;

use App\Models\saved;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function showSaved()
    {
        $saved = saved::with('bukus')->where('users_id', auth()->user()->id)->latest()->get();
        // dd($saved);
        return view('user_view.saved_buku', compact('saved'));
    }
}
