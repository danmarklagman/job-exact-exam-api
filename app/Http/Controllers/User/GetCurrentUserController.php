<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Http\Controllers\Controller;
use App\Services\User\GetCurrentUserService;
use App\Http\Requests\User\GetCurrentUserRequest;
use App\Http\Resources\Api\User\CurrentUserResource;

class GetCurrentUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        GetCurrentUserRequest $request,
        GetCurrentUserService $getCurrentUserService
    )
    {
        try {

            $user = $getCurrentUserService->run();

            return new CurrentUserResource($user);
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }
}
