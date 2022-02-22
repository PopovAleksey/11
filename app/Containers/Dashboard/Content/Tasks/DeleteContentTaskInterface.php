<?php

namespace App\Containers\Dashboard\Content\Tasks;

interface DeleteContentTaskInterface
{
    public function run(int $id): ?bool;
}