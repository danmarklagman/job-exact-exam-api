<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete();

            return $this->created('Logged out successfully.');
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }
}
