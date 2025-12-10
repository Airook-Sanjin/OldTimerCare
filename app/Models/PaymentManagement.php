<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentManagement extends Model
{
    protected $table = 'PaymentManagement';
    protected $primaryKey = 'PaymentID';

    protected $fillable = [
        'PatientID',
        'AppointmentID',
        'Amount',
        'Status'
    ];
}
