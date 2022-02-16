<?php

namespace App\Containers\Constructor\Seo\Tasks;

interface DeleteSeoTaskInterface
{
    public function run(int $id): ?bool;
}