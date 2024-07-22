<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $fillable = ['archiveID', 'borrowID', 'ISBN', 'userID', 'borrowDate', 'returnDate', 'bookStatus', 'status_when_lost', 'fine'];
    protected $primaryKey = 'archiveID';
}
