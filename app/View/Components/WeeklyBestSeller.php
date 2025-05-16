<?php

namespace App\View\Components;

use App\Models\Shop\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeeklyBestSeller extends Component
{
    /**
     * Create a new component instance.
     */
    public $products;
    public function __construct()
    {
   // Fetch the Weekly Best Seller category
   $category = Category::where('name', 'Weekly Best Seller')->first();

   // Fetch the products for that category along with their media
   if ($category) {
       $this->products = $category->products()->with('media')->get();
   } else {
       $this->products = collect(); // Empty collection if category not found
   }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.weekly-best-seller');
    }
}