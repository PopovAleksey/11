<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

interface DeleteTemplateTaskInterface
{
    public function run(int $id): void;
}