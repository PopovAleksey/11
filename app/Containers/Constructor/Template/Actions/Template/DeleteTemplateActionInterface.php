<?php

namespace App\Containers\Constructor\Template\Actions\Template;

interface DeleteTemplateActionInterface
{
    public function run(int $id): void;
}