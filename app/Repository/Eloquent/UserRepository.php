<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Model\User;
use App\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    private User $userModel;

    /**
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function updateModel(User $user, array $data): void
    {
        $user->email = $data['email'] ?? $user->email;
        $user->name= $data['name'] ?? $user->name;
        $user->avatar = $data['avatar'] ?? null;
        $user->save();
    }

    public function all(){
        return $this->userModel->get();
    }
    public function get(int $id){
        return $this->userModel->find($id);
    }


}



