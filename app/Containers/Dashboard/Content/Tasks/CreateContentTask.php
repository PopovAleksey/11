<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
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
     * @param \App\Ship\Parents\Dto\ContentDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(ContentDto $data): int
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ContentInterface $content
             */
            $content = $this->contentRepository->create(['page_id' => $data->getPageId()]);

            $data->getValues()->each(function (ContentValueDto $valueDto) use ($content) {
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

