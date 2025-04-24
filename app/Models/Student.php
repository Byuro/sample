<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // This allows mass-assignment of these fields
    protected $fillable = [
        'StudID',
        'lastname',
        'firstname',
        'sex',
        'age',
        'address',
        'contact_no',
        'course',
        'year',
    ];

    // Important: You’re using a custom primary key (StudID)
    protected $primaryKey = 'StudID';
    public $incrementing = false;
    protected $keyType = 'string';
}
