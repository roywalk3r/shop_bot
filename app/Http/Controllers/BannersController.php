<?php

namespace App\Http\Controllers;
use App\Models\Banners as Banner;
use App\Models\Shop\Product;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('frontend.index', compact('banners'));
    }
    // public function quickview(){
    //     $products = Product::all();
    //     return view('components.quick-view', compact('products'));
    // }
    public function store(Request $request)
    {
        $banners = Banner::all();
     
        if ($request->hasFile('photo')) {
            $banners->addMedia($request->file('photo'))->toMediaCollection('banners');
        }
    
        return redirect()->route('/banner');
    }
}