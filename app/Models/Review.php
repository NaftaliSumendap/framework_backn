<?php

Namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = ['user_id', 'product_id', 'rating', 'title', 'comment'];
}
?>