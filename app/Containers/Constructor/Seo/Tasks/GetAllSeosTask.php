<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Containers\Constructor\Seo\Models\SeoInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllSeosTask extends Task implements GetAllSeosTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->all()->collect()->map(static function (SeoInterface $Seo) {
                    return (new SeoDto())
                                ->setId($Seo->id)
                                ->setCreateAt($Seo->created_at)
                                ->setUpdateAt($Seo->updated_at);
                });
    }
}
