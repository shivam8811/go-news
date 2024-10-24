<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstOrCreate(array $array)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $table = 'categories';

    public function news()
    {
        return $this->belongsToMany(News::class, 'category_news');
    }
}
