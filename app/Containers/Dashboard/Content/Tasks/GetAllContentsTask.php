<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Containers\Dashboard\Content\Models\ContentInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllContentsTask extends Task implements GetAllContentsTaskInterface
{
    public function __construct(private ContentRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->all()->collect()->map(static function (ContentInterface $Content) {
                    return (new ContentDto())
                                ->setId($Content->id)
                                ->setCreateAt($Content->created_at)
                                ->setUpdateAt($Content->updated_at);
                });
    }
}
