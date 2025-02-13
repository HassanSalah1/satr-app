<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author_id', 'date', 'image', 'status','featured', 'link'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
