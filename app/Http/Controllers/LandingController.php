<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $data['bestProducts'] = Product::get()->take(3);
        return view('company-theme.welcome', $data);
    }

    public function aboutUs()
    {
        return view('company-theme.about.about');
    }

    public function product()
    {
        $data['products'] = Product::get();
        return view('company-theme.product', $data);
    }

    public function productDetail($slug)
    {
        $data['product'] = Product::where('slug', $slug)->first();
        return view('company-theme.product-detail', $data);
    }

    public function article()
    {
        return view('company-theme.blog.blog');
    }

    public function articleDetail($slug)
    {
        return view('company-theme.blog.detail_blog');
    }

    public function contact()
    {
        return view('company-theme.contact.contact');
    }
}
