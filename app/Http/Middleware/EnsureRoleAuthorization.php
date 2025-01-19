<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\RoleBasedAuthorizerInterface;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class EnsureRoleAuthorization
{
    public function __construct(
        private RoleBasedAuthorizerInterface $authorizer
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = $request->user();
        /** @var string $sub */
        $sub = $user->role;
        $obj = $request->path();
        $act = $request->method();

        if (!$this->authorizer->authorize($sub, $obj, $act)) {
            throw new AuthorizationException('not authorized');
        }

        return $next($request);
    }
}
