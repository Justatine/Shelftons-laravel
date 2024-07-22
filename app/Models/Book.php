<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['ISBN', 'bookImg', 'bookTitle', 'bookDesc', 'bookCat', 'publisher', 'yearPublished', 'date_added', 'popularity', 'replacementCost', 'stocks'];
    protected $primaryKey = 'ISBN';
}
