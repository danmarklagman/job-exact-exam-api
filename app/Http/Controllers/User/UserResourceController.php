<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\GetUserListRequest;
use App\Http\Resources\Api\User\UserListCollection;
use App\Http\Resources\Api\User\UserResource;
use App\Services\User\CreateUserService;
use App\Services\User\GetUserListService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserResourceController extends Controller
{
    public function __construct()
    {
        
    }

    public function all(
        GetUserListRequest $request,
        GetUserListService $getUserListService
    )
    {
        try {

            $users = $getUserListService->run();

            return new UserListCollection($users);
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }

    public function store(
        CreateUserRequest $request,
        CreateUserService $createUserService
    )
    {
        DB::beginTransaction();

        try {

            $createUserService->payload = $request->all();
            $user = $createUserService->run();
            DB::commit();

            return new UserResource($user);
        }
        catch (Exception $e) {

            DB::rollBack();
            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }

    public function modify()
    {

    }

    public function destroy()
    {

    }
}
