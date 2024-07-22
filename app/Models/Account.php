<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['userID', 'firstname', 'middlename', 'lastname', 'gender', 'birthdate', 'email', 'phoneNo', 'current_address', 'city', 'province', 'zipcode', 'username', 'password', 'userType', 'token'];
    protected $primaryKey = 'userID';
}
