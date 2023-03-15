<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function getAllTenants(int $pre_page);

    public function getTenantByUuid(String $uuid);
}
