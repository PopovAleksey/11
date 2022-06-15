<?php

namespace App\Containers\Core\Cacher\Actions;

interface CacheActionInterface
{
    public function run(): bool;
}