<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $data['cabang_toko'] = Cabang::with('users')->get();
        return view('cabang.index', $data);
    }
}
