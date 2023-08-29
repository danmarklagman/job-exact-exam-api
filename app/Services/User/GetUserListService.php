<?php

namespace App\Services\User;

use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Entities\Role\RoleRepositoryInterface;

class GetUserListService extends BaseService
{
    private RoleRepositoryInterface $roleRepositoryInterface;

    public function __construct(RoleRepositoryInterface $roleRepositoryInterface)
	{
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    public function run(): array
    {
        $role = $this->roleRepositoryInterface->findByFirst(['name' => 'normal']);
        
        return $role->rUsers->all();
    }
}
