<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholar extends Model
{
    use HasFactory;

    protected $fillable = [
        'month_year',
        'scholar_code',
        'institution',
        'unit',
        'area',
        'fullname',
        'name_of_member',
        'batch',
        'scholarship_type',
        'year_level',
        'course',
        'contact',
        'address',
        'status',
        'remarks',
        'account'
    ];
}