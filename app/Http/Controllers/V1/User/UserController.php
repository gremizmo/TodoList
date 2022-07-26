<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserRequest $request) {
        $credentials = $request->getAttributes();
        $user = $this->userService->createUser($credentials);
        $this->userService->saveUser($user);
        return $user;
    }

    public function show(User $user) { }

    public function update(Request $request, User $user) { }

    public function destroy(User $user) { }
}
