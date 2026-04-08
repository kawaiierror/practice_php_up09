<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    // Отключаем таймстампы, так как мы используем свои поля дат (issue_date, due_date)
    public $timestamps = false;

    protected $primaryKey = 'loan_id';

    protected $fillable = [
        'isbn',
        'user_id',
        'issue_date',
        'due_date',
      //  'return_date' // на случай, если будете фиксировать реальный возврат
    ];

    // Связь с книгой (много заявок могут относиться к одной книге)
    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }

    // Связь с пользователем (заявка принадлежит пользователю)
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
//// Получаем текущего пользователя со всеми его заявками
//$user = app()->auth::user();
//$myLoans = $user->loans; // Коллекция всех заявок пользователя
//
//// Если нужно вывести названия книг, которые он забронировал:
//foreach ($myLoans as $loan) {
//    echo "Книга: " . $loan->book->book_name;
//    echo " Вернуть до: " . $loan->due_date;
//}