<?php

namespace App\Services;

interface RoleBasedAuthorizerInterface
{
    /**
     * 権限による認可処理を行う
     *
     * @param string $subject
     * @param string $object
     * @param string $action
     * @return bool
     */
    public function authorize(string $subject, string $object, string $action): bool;
}
