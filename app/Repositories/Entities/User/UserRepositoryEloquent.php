<?php

namespace App\Repositories\Entities\User;

use App\Repositories\BaseRepositoryEloquent;
use App\Models\User;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepositoryInterface
{
    /**
     * UserRepositoryEloquent constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
