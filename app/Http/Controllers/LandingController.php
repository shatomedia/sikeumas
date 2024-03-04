<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $data['bestProducts'] = Product::get()->take(3);
        return view('welcome', $data);
    }
}
