<?php

namespace App\Http\Controllers;

function base64url_encode($input, $padding = true)
{
    $output = strtr(base64_encode($input), '+/', '-_');
    return ($padding) ? $output : str_replace('=', '', $output);
}

function base64url_decode($input)
{
    $input .= str_repeat('=', (4 - strlen($input) % 4) % 4);
    return base64_decode(strtr($input, '-_', '+/'), true);
}


class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        $expires = auth()->factory()->getTTL() * 60;

        $response = response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expires
        ]);                

        return $response;
    }
}