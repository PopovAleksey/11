<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Containers\Constructor\Template\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllTemplatesTask extends Task implements GetAllTemplatesTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->all()->collect()->map(static function (TemplateInterface $Template) {
                    return (new TemplateDto())
                                ->setId($Template->id)
                                ->setCreateAt($Template->created_at)
                                ->setUpdateAt($Template->updated_at);
                });
    }
}
