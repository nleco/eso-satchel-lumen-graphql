<?php

namespace App\GraphQL\Mutations;

use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\GraphQL\Types\Error;
use App\GraphQL\Types\Success;

class CreateAccount
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            DB::beginTransaction();

            $user = new User();
            $user->id = Str::uuid();
            $user->name = trim($args["name"]);
            $user->email = $args["email"];
            $user->password = Hash::make($args["password"]);
            $user->save();
        } catch (Throwable $t) {
            DB::rollback();

            return new Error([
                "message" => "User not created.",
            ]);
        }

        DB::commit();

        return new Success([
            "message" => "Account created.",
        ]);
    }
}
