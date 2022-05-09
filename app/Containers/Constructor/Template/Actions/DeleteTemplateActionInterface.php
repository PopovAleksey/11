<?php

namespace App\Containers\Constructor\Template\Actions;

interface DeleteTemplateActionInterface
{
    public function run(int $id): void;
}