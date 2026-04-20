<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'loan_id';

    protected $fillable = [
        'isbn',
        'user_id',
        'issue_date',
        'due_date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}