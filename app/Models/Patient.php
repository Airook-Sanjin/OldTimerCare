<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'Patient'; // MUST match your table exactly
    protected $primaryKey = 'PatientID';
    public $timestamps = false; // your table has no timestamps
}
