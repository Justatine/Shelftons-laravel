<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowdetail extends Model
{
    use HasFactory;
    protected $fillable = ['borrowID', 'userID', 'ISBN', 'borrowDate', 'returnSchedule', 'returnDate', 'borrowStatus', 'returnStatus', 'fine'];
    protected $primaryKey = 'borrowID';
}
