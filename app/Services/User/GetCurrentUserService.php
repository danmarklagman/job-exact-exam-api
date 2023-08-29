<?php

namespace App\Services\User;

use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class GetCurrentUserService extends BaseService
{
    public function run(): Authenticatable
    {
        return Auth::user();
    }
}
