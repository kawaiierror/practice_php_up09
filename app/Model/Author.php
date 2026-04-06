<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'author_id';
    protected $fillable = [
        'name',
        'last_name',
        'year_of_birth',
        'year_of_death',
        ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}