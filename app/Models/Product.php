<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'image',
        'user_id',
        'published_at',
        'archived_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
