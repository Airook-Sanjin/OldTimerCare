<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable=['FamilyMemberID','UserID','PatientID',
                        'Relationship'];

    public function User(){
        return $this->belongsTo(User::class);
}
}