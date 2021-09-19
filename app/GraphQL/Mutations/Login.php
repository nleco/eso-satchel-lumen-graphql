<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Error;

class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $email = $args["email"];
        $password = $args["password"];

        // using tymon/jwt-auth
        $token = auth()->attempt([$email => $email, "password" => $password]);

        if (false === $token) {
            return new Error(["message" => "Username or password is invalid."]);
        }

        // if (($user = auth()->user())->is_banned) {
        //     return new Error(["message" => "Your account is unavailable at this moment."]);
        // }

        // Login payload is like the Error and Success class
        return new LoginPayload([
            "access_token" => $token,
            "type" => "bearer",
            "expires_in" =>
                auth()
                    ->factory()
                    ->getTTL() * 60,
        ]);
    }
}
