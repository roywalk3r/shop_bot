<?php

namespace App\Http\Controllers;

use App\Models\Shop\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Eager load the relationships
        $categories = Category::with('children', 'parent', 'products')->get();

        // Pass the data to the view
        return view('frontend.test01', compact('categories'));
    }
}