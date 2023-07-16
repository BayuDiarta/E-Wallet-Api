<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findUserByEmail(string $email)
    {
        return DB::table('users')->where('email', $email)->first();
    }

    public function getById(int $id){
        
        return DB::table('users')
        ->select('users.id', 'wallets.id', 'wallets.balance', 'wallets.user_id')
        ->join('wallets', 'users.id', '=', 'wallets.user_id')
        ->where('users.id', $id)
        ->first();
    }

    public function registerUser(array $users)
    {
        return User::create($users);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->model->findOrFail($id);
        $user = $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
