<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $data['bestProducts'] = Product::latest()->take(3)->get();
        return view('company-theme.welcome', $data);
    }

    public function aboutUs()
    {
        return view('company-theme.about.about');
    }

    public function taqwaHub()
    {
        return view('company-theme.taqwa-hub-landing');
    }

    public function surgeryTime()
    {
        return view('company-theme.surgery-time-landing');
    }

    public function jwsM3()
    {
        return view('company-theme.jws-m3-landing');
    }

    public function product()
    {
        $data['products'] = Product::get();
        return view('company-theme.product', $data);
    }

    public function productDetail($slug)
    {
        $data['product'] = Product::with('category')->where('slug', $slug)->firstOrFail();
        $data['otherProducts'] = Product::where('slug', '!=', $slug)->latest()->take(3)->get();
        return view('company-theme.product.detail_product', $data);
    }

    public function article()
    {
        $data['articles'] = Article::with('CategoryArtikel')->latest()->get();
        return view('company-theme.blog.blog', $data);
    }

    public function articleDetail($slug)
    {
        $data['article'] = Article::where('slug', $slug)->first();
        $data['latestArticles'] = Article::latest()->take(7)->get();
        return view('company-theme.blog.detail_blog', $data);
    }

    public function contact()
    {
        return view('company-theme.contact.contact');
    }
}
