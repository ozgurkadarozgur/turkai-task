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

class StudentRepository implements IStudentRepository
{

    public function findById(int $id): ?Student
    {
        $student = Student::findOrFail($id);
        return $student;
    }

    public function findByCode(string $code): ?Student
    {
        $student = Student::where('code', $code)->first();
        return $student;
    }

    public function all(): Collection
    {
        $students = Student::all();
        return $students;
    }

    public function create(array $data): ?Student
    {
        $student = Student::create($data);
        return $student;
    }

    public function update(int $id, array $data): ?Student
    {
        $student = $this->findById($id);
        $student->update($data);
        return $student;
    }
}