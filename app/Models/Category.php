<?php

Namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
    'name',
    'description',
    ];

    protected static function boot()
    {
    parent::boot();

    static::creating(function ($category) {
        $category->slug = Str::slug($category->name);
    });

    static::updating(function ($category) {
        $category->slug = Str::slug($category->name);
    });
    }
}
?>