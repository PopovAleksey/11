<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class IndexBuilderTask extends Task implements IndexBuilderTaskInterface
{
    public function run(): Collection
    {
        return collect();
    }
}
