<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Shop\Category;

class CategoryList extends Component
{
    public $categories;

    public function __construct()
    {
        $this->categories = Category::with('children', 'parent', 'products')->get();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-list');
    }
}