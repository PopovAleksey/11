<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\TemplateWidgetDto;
use App\Ship\Parents\Repositories\TemplateWidgetRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateTemplateWidgetTask extends Task implements UpdateTemplateWidgetTaskInterface
{
    public function __construct(private TemplateWidgetRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateWidgetDto $data
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(TemplateWidgetDto $data): void
    {
        try {
            $this->repository->updateOrCreate(
                [
                    'template_id' => $data->getTemplateId(),
                ],
                [
                    'count_elements' => $data->getCountElements(),
                    'show_by'        => $data->getShowBy(),
                ]
            );

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
