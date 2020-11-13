<?php


namespace App\Managers;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserManager
{
    public function __construct()
    {
    }

    public function register(array $data)
    {
        $user = $this->add($data);

        event(new Registered($user));

        return $user;
    }

    public function add(array $data)
    {
        return User::create($data);
    }

    public function verified(MustVerifyEmail $user)
    {
        $user->markEmailAsVerified();

        event(new Verified($user));
    }

}
