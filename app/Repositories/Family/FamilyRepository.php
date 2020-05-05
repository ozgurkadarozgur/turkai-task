<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 03.05.2020
 * Time: 01:24
 */

namespace App\Repositories\Family;


use App\Family;
use Illuminate\Support\Collection;

class FamilyRepository implements IFamilyRepository
{

    public function findById(int $id): ?Family
    {
        $family = Family::findOrFail($id);
        return $family;
    }

    public function findByEmail(string $email): ?Family
    {
        $family = Family::where('email', $email)->first();
        return $family;
    }

    public function all(): Collection
    {
        $families = Family::all();
        return $families;
    }

    public function create(array $data): ?Family
    {
        $family = Family::create([
            'student_id' => $data['student_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        return $family;
    }

    public function update(int $id, array $data): ?Family
    {
        $family = $this->findById($id);
        $family->update($data);
        return $family;
    }
}