<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\CheckAuthenticationService as AuthCheckAuthenticationService;
use App\Services\Auth\CheckAuthService;
use App\Services\Authentication\CheckAuthenticationService;
use Exception;
use Illuminate\Http\Request;

class CheckAuthController extends Controller
{
    private CheckAuthService $checkAuthService;

    public function __construct(CheckAuthService $checkAuthService)
    {
        $this->checkAuthService = $checkAuthService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {

            $isAuthenticated = $this->checkAuthService->run();
            if (!$isAuthenticated) {
                return $this->unauthorized('Unauthorized session.');
            }

            return $this->created('Session is authorized.');
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }
}
