<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Http\Traits\DateTimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory , DateTimeTrait;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'status'   => StatusEnum::class
    ];

    public function scopePublished($query)
    {
        return $query->where('status' , StatusEnum::PUBLISHED);
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('published_at' , 'asc');
    }
}
