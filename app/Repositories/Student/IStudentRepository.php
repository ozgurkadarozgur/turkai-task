<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 03.05.2020
 * Time: 01:25
 */

namespace App\Repositories\Student;


use App\Student;
use Illuminate\Support\Collection;

interface IStudentRepository
{
    public function findById(int $id) : ?Student;

    public function findByCode(string $code) : ?Student;

    public function all() : Collection;

    public function create(array $data) : ?Student;

    public function update(int $id, array $data) : ?Student;
}