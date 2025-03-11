<?php

namespace App\Services;

class UserServices
{
    public function createUser(array $data):User{
        return User::create($data);
    }
    
}