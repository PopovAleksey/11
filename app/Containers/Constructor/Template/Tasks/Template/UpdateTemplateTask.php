<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Storage;

class UpdateTemplateTask extends Task implements UpdateTemplateTaskInterface
{
    public function __construct(
        private TemplateRepositoryInterface       $templateRepository,
        private GetTemplatesFilepathTaskInterface $getTemplatesFilepathTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto $data
     * @return \App\Ship\Parents\Dto\TemplateDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(TemplateDto $data): TemplateDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\TemplateInterface $template
             */
            $template = $this->templateRepository->find($data->getId());
            $storage  = Storage::disk('template');

            [$commonFile, $elementFile, $previewFile] = $this->getTemplatesFilepathTask->run($template);

            if ($template->common_filepath !== null) {
                $storage->put($commonFile, $data->getCommonHtml());
            }

            if ($template->element_filepath !== null) {
                $storage->put($elementFile, $data->getElementHtml());
            }

            if ($template->preview_filepath !== null) {
                $storage->put($previewFile, $data->getPreviewHtml());
            }

            return (new TemplateDto())
                ->setId($template->id)
                ->setCreateAt($template->created_at)
                ->setUpdateAt($template->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
