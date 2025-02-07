<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        try {
            ($token = Auth::attempt($credentials)) ?: throw new \Exception('Invalid login credentials provided');

            $user = User::where('id', Auth::user()->id)->first();

            $data = [
                'success' => true,
                'message' => 'User logged in Successfully',
                'user' => new UserResource($user),
                'access_token' => $token,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid login credentials provided'
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
