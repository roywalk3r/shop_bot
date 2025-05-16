<?php

namespace App\Models;

use App\Casts\MoneyCast;

use App\Http\Controllers\WeeklyBestSellerController;
use App\Models\Shop\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use App\Models\Shop
class WeeklyBestSeller extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
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
        return view('components.weekly-best-seller');
    }
    protected $casts = [
        'price' => MoneyCast::class,
     ];
    use HasFactory;
    use InteractsWithMedia;
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-images')->singleFile();
    }
    
}