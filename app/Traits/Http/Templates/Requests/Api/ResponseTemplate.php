<?php

namespace App\Traits\Http\Templates\Requests\Api;

use App\Enums\StatusCodeEnum;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait ResponseTemplate
{   
    // The request has been successful and this will reply a message
    protected function success($message, $result = [], $withLogging = true, $status = StatusCodeEnum::SUCCESS): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->info($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => true,
            'result'   => $result, 
            'message' => $message,
        ], $status);
    }

    // The request has been successful and this will send back the resulting data with a message
    protected function created($message, $result = [], $withLogging = true, $status = StatusCodeEnum::CREATED): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->info($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => true,
            'result' => $result,
            'message' => $message,
        ], $status);
    }

    // The request has been successful but not acted upon and this will reply a message
    protected function accepted($message, $result = [], $withLogging = true, $status = StatusCodeEnum::ACCEPTED): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->info($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => true,
            'result'   => $result, 
            'message' => $message,
        ], $status);
    }

    // The request has been unsuccessful and this will only send the error message
    protected function error($message, $result = [], $withLogging = true,  $status = StatusCodeEnum::ERROR): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->error($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => false,
            'result' => $result,
            'message' => $message,
        ], $status);
    }

    // The request has an invalid syntax and this will send back the data that was thrown with the error message
    protected function badRequest($message, $result = [], $withLogging = true, $status = StatusCodeEnum::BAD_REQUEST): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->warning($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => false,
            'result' => $result,
            'message' => $message,
        ], $status);
    }

    // The request has been denied due to invalid login token and this will send back a message
    protected function unauthorized($message, $result = [], $withLogging = true, $status = StatusCodeEnum::UNAUTHORIZED): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->critical($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }
        
        return response([
            'success' => false,
            'result' => $result,
            'message' => $message,
        ], $status);
    }

    // The request has been accepted but does not have the authority to access the target endpoint and this will send back a message
    protected function forbidden($message, $result = [], $withLogging = true, $status = StatusCodeEnum::FORBIDDEN): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->alert($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => false,
            'result' => $result,
            'message' => $message,
        ], $status);
    }

    protected function notFound($message, $result = [], $withLogging = true, $status = StatusCodeEnum::NOT_FOUND): Response | ResponseFactory
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->alert($this->getCurrentRouteName() . ' | ' . $message, (array)$result);
        }

        return response([
            'success' => false,
            'result' => $result,
            'message' => $message,
        ], $status);
    }

    // Send back the data as a JSON response
    protected function json($result): JsonResponse
    {
        return response()->json($result);
    } 
    
    // Send back the data as a JSON response
    protected function sendToken($token, $result): Response | ResponseFactory
    {
        $message = 'Successfully created an access token.';

        $result['access_token'] = $token->accessToken;
        $result['token_type'] = 'Bearer';
        $result['expires_at'] = Carbon::parse(
                $token->token->expires_at
            )->toDateTimeString();

        $logChanel = $this->getLogChannel();

        return $this->created($message, $result);
    }    
    
}
