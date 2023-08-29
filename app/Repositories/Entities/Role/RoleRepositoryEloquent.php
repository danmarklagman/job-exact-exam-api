<?php

namespace App\Repositories\Entities\Role;

use App\Repositories\BaseRepositoryEloquent;
use App\Models\UserRole;

class RoleRepositoryEloquent extends BaseRepositoryEloquent implements RoleRepositoryInterface
{
    /**
     * RoleRepositoryEloquent constructor.
     *
     * @param UserRole $model
     */
    public function __construct(UserRole $model)
    {
        parent::__construct($model);
    }
}
