<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Facades\Gate;
use Throwable;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list()
    {

//        Gate::authorize('admin');

        $users = $this->userRepository->all();

        return view('user.list',['users'=>$users]);
    }

    public function show(int $userId)
    {
        $user = $this->userRepository->get($userId);
        return view('user.show', ['user'=>$user]);
    }
}
