<?php

namespace App\Containers\Constructor\Seo\Actions;

interface DeleteSeoActionInterface
{
    public function run(int $id): void;
}