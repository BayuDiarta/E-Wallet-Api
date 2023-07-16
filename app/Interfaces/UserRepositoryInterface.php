<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function findUserByEmail(string $email);

    public function getById(int $id);

    public function registerUser(array $users);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}