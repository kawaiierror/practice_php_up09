<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'book_name',
        'year',
        'price',
        'author_id',
        'category_id',
        'is_new',
        'annotation',
        'image' // добавляю обложку
    ];

    public function author()
    {

        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id');
    }
}