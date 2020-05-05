<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * @package App
 * @property-read $id
 * @property-write $first_name
 * @property-write $last_name
 * @property-write $code
 */
class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'first_name', 'last_name', 'code',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'id', 'student_id');
    }

    public function __toString()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
