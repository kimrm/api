<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
        'user_id',
        'published_at',
        'archived_at',
        'deleted_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
