<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSchedules extends Model
{
    protected $table = 'EmployeeSchedules';
    protected $primaryKey = 'ESID'; 

    protected $fillable = [
        'TimeslotId',
        'EmployeeID',
        'PatientID',
        'Date',
    ];
}
