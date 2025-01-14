<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserListCollection;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * @return UserListCollection
     */
    public function __invoke(): UserListCollection
    {
        $users = User::query()->paginate(10);

        return new UserListCollection($users);
    }
}
