<?php

namespace App\Services\User;

use App\Repositories\Entities\Role\RoleRepositoryInterface;
use App\Repositories\Entities\User\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;

class CreateUserService extends BaseService
{
    protected UserRepositoryInterface $userRepositoryInterface;
    protected RoleRepositoryInterface $roleRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        RoleRepositoryInterface $roleRepositoryInterface
    )
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    public function run(): Model
    {
        $role = $this->roleRepositoryInterface->findByFirst(
            ['name' => 'normal']
        );

        $payload = array_merge($this->payload, [
            'user_role_id' => $role->id,
        ]);

        $user = $this->userRepositoryInterface->create($payload);

        return $user->fresh();
    }
}
