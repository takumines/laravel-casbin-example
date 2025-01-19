<?php

namespace App\Services\casbin;

use App\Services\RoleBasedAuthorizerInterface;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use Casbin\Persist\Adapters\FileAdapter;

class CasbinRoleBasedAuthorizationService implements RoleBasedAuthorizerInterface
{
    protected Enforcer $enforcer;

    /**
     * @throws
     */
    public function __construct()
    {
        $policyFile = base_path('app/Services/casbin/admin_rbac_policy.csv');
        $adapter = new FileAdapter($policyFile);

        $modelFile = base_path('app/Services/casbin/model.conf');
        $this->enforcer = new Enforcer($modelFile, $adapter);
    }

    /**
     * リソースへのアクセスが許可されているかを判定
     *
     * @param string $subject ユーザーのロール
     * @param string $object リソース名
     * @param string $action アクション名
     * @return bool
     * @throws CasbinException
     */
    public function authorize(string $subject, string $object, string $action): bool
    {
        return $this->enforcer->enforce($subject, $object, $action);
    }
}
