<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;
    protected $fillable = ['Scholar_code','Date','Date_memo','MemoNumber', 'amount','return_cmdi', 'remarks'];

   

}
