<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Managers\UserManager;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request, UserManager $userManager)
    {
        $user = $userManager->register($request->all());

        return new JsonResource($user);
    }

    public function verify(EmailVerificationRequest $request, UserManager $userManager)
    {
        $userManager->verified($request->user());
    }
}
