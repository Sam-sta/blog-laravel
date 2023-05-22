<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'description', 'user_id'];

    public function posts() 
    {
        return $this->HasMany(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
