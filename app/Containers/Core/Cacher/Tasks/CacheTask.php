<?php

namespace App\Containers\Core\Cacher\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CacheTask extends Task implements CacheTaskInterface
{
    public function run()
    {
        try {
            return 0;
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}

