<?php

namespace App\Models;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'UserID';
    public $timestamps = false; 

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Address',
        'Password',
        'Phone',
        'DateOfBirth',
        'ProfileImage'
    ];

    
  

    protected function setPasswordAttribute($value){
        $this->attributes['Password'] = Hash::make($value);
    }
   
    public function getAuthPassword()
    {
        return $this->Password;
    }


    public function Employee()
    {
        return $this->hasOne(\App\Models\Employee::class, 'UserID', 'UserID');
    }
    // public $timestamps = true;
    // public function Employee()
    // {
    //     return $this->hasOne(Employee::class);
    // }

    // public function Patient()
    // {
    //     return $this->hasOne(Patient::class);
    // }

    // public function FamilyMember()
    // {
    //     return $this->hasOne(FamilyMember::class);
    // }
    public function username()
{
    return 'Email';  // your column name
}

}
