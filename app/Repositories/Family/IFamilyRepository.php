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

interface IFamilyRepository
{
    public function findById(int $id) : ?Family;

    public function findByEmail(string $email) : ?Family;

    public function all() : Collection;

    public function create(array $data) : ?Family;

    public function update(int $id, array $data) : ?Family;
}