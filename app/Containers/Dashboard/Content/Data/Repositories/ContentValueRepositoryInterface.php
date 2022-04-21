<?php

namespace App\Containers\Dashboard\Content\Data\Repositories;

interface ContentValueRepositoryInterface
{
    public function updateByCondition(array $data, array $condition): bool;
}