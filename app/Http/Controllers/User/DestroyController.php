<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    /**
     * @param int $userId
     * @return Response
     */
    public function __invoke(int $userId): Response
    {
        $user = User::query()->findOrFail($userId);
        $user->delete();

        return response()->noContent();
    }
}
