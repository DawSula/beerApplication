<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\User;

interface UserRepositoryInterface
{
    public function updateModel(User $user, array $data):void;
    public function all();
    public function get(int $id);
}
