<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementDate extends Model
{
    protected $table = 'disbursement_date'; // Update the table name here

    protected $fillable = [
        'month',
        'year',
        'scholar_id',
    ];

    // Define the relationship between DisbursementDate and Scholar
    public function scholar()
    {
        return $this->belongsTo(Scholar::class);
    }
}
