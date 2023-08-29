<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use App\Services\User\GetUserByParameterService;
use Exception;
use Illuminate\Http\Request;

class FindUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        GetUserByParameterService $getUserByParameterService,
        string $id
    )
    {
        try {

            $getUserByParameterService->parameter = [
                'column'    => 'id',
                'value'     => $id,
            ];
            $user = $getUserByParameterService->run();

            return new UserResource($user);
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }
}
