<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaManagerController extends Controller
{
    public function index()
    {
        // Load media manager view
        return view('filament.media-manager.index');
    }
}