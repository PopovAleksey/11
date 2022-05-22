<?php

namespace App\Containers\Constructor\Page\Actions;

interface DeletePageActionInterface
{
    public function run(int $id): void;
}