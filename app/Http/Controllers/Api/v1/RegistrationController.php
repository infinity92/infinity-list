<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Managers\UserManager;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request, UserManager $userManager)
    {
        $user = $userManager->register($request->all());

        return new JsonResource($user);
    }

    public function verify($id, $hash, UserManager $userManager)
    {
        $user = User::find($id);
        if ($user && $userManager->checkVerifiedCode($user, $id, $hash) ) {
            $userManager->verified($user);
            return new JsonResource($user);
        }

        throw new AuthenticationException('User email verification error');
    }
}
