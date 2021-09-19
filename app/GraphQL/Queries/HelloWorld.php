<?php

namespace App\GraphQL\Queries;

class HelloWorld
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return "This is a simple hello world query";
    }
}
