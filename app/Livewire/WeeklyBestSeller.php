<?php

namespace App\Livewire;

use App\Models\Shop\Category;
use Livewire\Component;
use App\Http\Controllers\WeeklyBestSellerController as Weekbest;

class WeeklyBestSeller extends Component
{
    public $products;

    public function mount()
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
    public function render()
    {
        return view('livewire.weekly-best-seller' );
    }
}