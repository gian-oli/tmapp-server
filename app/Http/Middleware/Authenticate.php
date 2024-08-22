<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use ResponseTrait;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $result = $this->successResponse('User Authenticated');
        try {
            $result = $request->expectsJson();
        } catch(\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
}
