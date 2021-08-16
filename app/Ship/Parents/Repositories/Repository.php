<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as AbstractRepository;

abstract class Repository extends AbstractRepository
{
    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        parent::boot();
    }

    public function model(): string
    {
        return parent::model();
    }

    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        return parent::paginate($limit, $columns, $method);
    }
}
