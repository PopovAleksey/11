<?php

namespace App\Containers\Dashboard\Content\Actions;

interface DeleteContentActionInterface
{
    public function run(int $id): void;
}