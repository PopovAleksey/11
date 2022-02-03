<?php

namespace App\Containers\Constructor\Page\Tasks;

interface DeleteFieldTaskInterface
{
    public function run(int $id): ?bool;
}