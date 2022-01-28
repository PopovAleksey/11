<?php

namespace App\Containers\Constructor\Page\Tasks;

interface DeletePageTaskInterface
{
    public function run(int $id): ?bool;
}