<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;
    protected $fillable = ['Scholar_code','scholar_name','institution','unit','area','batch','scholarship_type','year_level','status','account','Date','Date_memo','MemoNumber', 'amount','return_cmdi', 'disbursement_remarks'];

   

}
