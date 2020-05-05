<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * Class Family
 * @package App
 * @property-read $id
 * @property-read $student_id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $password
 */
class Family extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $table = 'families';

    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'email', 'password',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id','student_id');
    }

    public function __toString()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
