<?php

namespace App\Containers\Constructor\Template\Tasks;

interface DeleteTemplateTaskInterface
{
    public function run(int $id): void;
}