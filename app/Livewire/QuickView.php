<?php

namespace App\Http\Livewire;

use App\Models\Shop\Product;
use Livewire\Component;

class QuickView extends Component
{
    public $product;
    public $productId;

    // Livewire automatically injects the $productId from the blade component
    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
    }

    public function render()
    {
        return view('livewire.quick-view');
    }
}