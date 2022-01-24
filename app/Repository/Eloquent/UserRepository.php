<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Model\User;
use App\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function updateModel(User $user, array $data): void
    {
        $user->email = $data['email'] ?? $user->email;
        $user->name= $data['name'] ?? $user->name;
        $user->avatar = $data['avatar'] ?? null;
        $user->save();
    }
}



