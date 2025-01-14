<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class ShowController extends Controller
{
    /**
     * @param int $userId
     * @return UserResource
     */
    public function __invoke(int $userId): UserResource
    {
        $user = User::query()->findOrFail($userId);

        return new UserResource($user);
    }
}
