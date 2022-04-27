<?php

namespace App\Ship\Parents\Repositories;

interface ContentValueRepositoryInterface
{
    public function updateByCondition(array $data, array $condition): bool;
}