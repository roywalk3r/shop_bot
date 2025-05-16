<?php

namespace App\Http\Controllers;

use App\Models\Banners as Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('frontend.test', compact('banners'));
    }
    public function store(Request $request)
    {
        $banners = Banner::all();
     
        if ($request->hasFile('photo')) {
            $banners->addMedia($request->file('photo'))->toMediaCollection('banners');
        }
    
        return redirect()->route('your_route');
    }
}