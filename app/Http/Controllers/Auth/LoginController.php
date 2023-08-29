<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Enums\TokenEnum;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Login\LoginRequest;
use App\Services\User\GetUserEmailService;
use App\Http\Resources\Api\Login\LoginResource;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private GetUserEmailService $getUserEmailService;

    public function __construct(GetUserEmailService $getUserEmailService)
    {
        $this->getUserEmailService = $getUserEmailService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): Response | ResponseFactory | LoginResource
    {
        try {

            $this->getUserEmailService->emailAddress = $request->input('email');
            $user = $this->getUserEmailService->run();
            Log::info('User', compact('user'));

            if ($user) {
                if ($user->rRole->name == 'authorized') {
                    if (Hash::check($request->input('password'), $user->password)) {
                        $token = $user->createToken(TokenEnum::LOGIN_TOKEN)->plainTextToken;
                        $user->access_token = $token;
                        return new LoginResource($user);
                    } else {
                        return $this->badRequest(
                            'Incorrect password.',
                            $request->all()
                        );
                    }
                } else {
                    return $this->badRequest(
                        'User is not authorized to access the system.',
                        $request->all()
                    );    
                }
            } else {
                return $this->badRequest(
                    'Incorrect email or password.',
                    $request->all()
                );
            }
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }
}
