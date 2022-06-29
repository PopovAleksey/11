<?php

namespace App\Containers\Constructor\Localization\Actions;

interface DeleteLocalizationActionInterface
{
    public function run(int $id): void;
}