<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->user->find($id);
    }
}
