<?php

namespace App\Models\Task1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
