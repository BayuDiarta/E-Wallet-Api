<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserService {
   protected $userRepository;

   public function __construct(UserRepository $userRepository) {
      $this->userRepository = $userRepository;
   }

   public function profile(int $id)
   {
      $profile = $this->userRepository->getById($id);
      return $profile;
   }

   public function create(array $data) {
      $user = $this->userRepository->create($data);
      return $user;
   }

   public function update(int $id, array $data) {
      $user = $this->userRepository->update($id, $data);
      return $user;
   }

   public function delete(int $id) {
      return $this->userRepository->delete($id);
   }
}
