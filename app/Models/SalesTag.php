<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop\Product;
class SalesTag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

 
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sales_tag');
    }

}