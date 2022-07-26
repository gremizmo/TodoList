<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;

class UserController extends Controller
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

    public function store(UserRequest $request) {
        $credentials = $request->getAttributes();
        // 3. On enregistre les informations du Post
        $user = $this->userFactory->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->userRepository->create($user);

        return $user;
    }

    public function show(User $user) { }

    public function update(Request $request, User $user) { }

    public function destroy(User $user) { }
}
