<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

interface DeleteFieldTaskInterface
{
    public function run(int $id): void;
}