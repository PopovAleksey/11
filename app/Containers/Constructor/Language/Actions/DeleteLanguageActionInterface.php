<?php

namespace App\Containers\Constructor\Language\Actions;

interface DeleteLanguageActionInterface
{
    public function run(int $id): void;
}
