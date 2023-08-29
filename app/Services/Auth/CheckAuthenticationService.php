<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class CheckAuthService extends BaseService
{
    public function run()
    {
        return Auth::check();
    }
}
