<?php

namespace App\Ship\Parents\Tasks;

use Apiato\Core\Abstracts\Tasks\Task as AbstractTask;

abstract class Task extends AbstractTask
{
    public function addRequestCriteria($repository = null): self
    {
        return parent::addRequestCriteria($repository);
    }

    public function removeRequestCriteria($repository = null): self
    {
        return parent::removeRequestCriteria($repository);
    }
}
