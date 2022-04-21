<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Dto\ContentValueDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Containers\Dashboard\Content\Data\Repositories\ContentValueRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateContentTask extends Task implements CreateContentTaskInterface
{
    public function __construct(
        private ContentRepositoryInterface      $contentRepository,
        private ContentValueRepositoryInterface $contentValueRepository
    )
    {
    }

    /**
     * @param \App\Containers\Dashboard\Content\Data\Dto\ContentDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(ContentDto $data): int
    {
        try {
            /**
             * @var \App\Containers\Dashboard\Content\Models\ContentInterface $content
             */
            $content = $this->contentRepository->create(['page_id' => $data->getPageId()]);

            collect($data->getValues())->each(function (ContentValueDto $valueDto) use ($content) {
                $data = [
                    'language_id'   => $valueDto->getLanguageId(),
                    'content_id'    => $content->id,
                    'page_field_id' => $valueDto->getPageFieldId(),
                    'value'         => $valueDto->getValue(),
                ];

                $this->contentValueRepository->create($data);
            });

            return $content->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

