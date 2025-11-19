<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Patient extends Model
{
    use HasFactory;

    protected $fillable =['PatientID', 'UserID','DoctorID','CaregiverID','Total'];

    public function User(){
        return $this->belongsTo(User::class);
}
}
