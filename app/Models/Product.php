<?php

Namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
    'name',
    'slug',
    'price',
    'stock',
    'category_id',
    'description',
    'brand',
    'specifications',
    'discount_price',
    'is_featured',
    'image_path',
    ];



}
?>