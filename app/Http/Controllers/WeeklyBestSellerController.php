<?php

namespace App\Http\Controllers;

use App\Models\WeeklyBestSeller;
use Illuminate\Http\Request;

class WeeklyBestSellerController extends Controller
{

    public function index()
    {
        $weeklyBestSellers = WeeklyBestSeller::all();
        return $weeklyBestSellers;
    }
    public function store(Request $request)
    {

        $weeklyBestSellers = WeeklyBestSeller::all();

        if ($request->hasFile('media')) {
            $weeklyBestSellers->addMedia($request->file('media'))->toMediaCollection('product-images');
        }

        return response()->json($weeklyBestSellers);
    }}