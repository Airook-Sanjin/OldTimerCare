<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $fillable =['UserID','FirstName','LastName','Email','Phone','Address','Password','DOB'];
   
    public function Employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function Patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function FamilyMember()
    {
        return $this->hasOne(FamilyMember::class);
    }
}
