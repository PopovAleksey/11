<?php

namespace App\Containers\Constructor\Localization\Tasks;

interface DeleteLocalizationTaskInterface
{
    public function run(int $id): void;
}