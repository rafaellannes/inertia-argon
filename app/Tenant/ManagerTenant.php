<?php

namespace App\Tenant;

class ManagerTenant
{
    public function getTenantIdentify()
    {
        return auth()->check() ? auth()->user()->prefeitura_id : '';
    }

    public function getTenant()
    {
        return auth()->check() ? auth()->user()->prefeitura : '';
    }

    public function isAdmin(): bool
    {
        return auth()->user->isAdmin ? true : false;
    }
}
