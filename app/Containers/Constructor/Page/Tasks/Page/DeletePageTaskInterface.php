<?php

namespace App\Containers\Constructor\Page\Tasks\Page;

interface DeletePageTaskInterface
{
    public function run(int $id): void;
}