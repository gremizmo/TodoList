<?php

namespace App\Http\Controllers\Services;

use App\Http\Repositories\UserRepository;
use Database\Factories\UserFactory;

class UserService
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserFactory
     */
    protected $userFactory;

    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    public function createUser(array $credentials) {
        return $this->userFactory->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function saveUser($user) {
        return $this->userRepository->create($user);
    }
}
