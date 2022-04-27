<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Models\ContentValueInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateContentTask extends Task implements UpdateContentTaskInterface
{
    public function __construct(private ContentValueRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ContentDto $contentDto
     * @return bool
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ContentDto $contentDto): bool
    {
        try {
            $contentValueIds = [];
            $this->repository
                ->findByField('content_id', $contentDto->getId())
                ->each(static function (ContentValueInterface $contentValue) use (&$contentValueIds) {
                    $contentValueIds[$contentValue->language_id][$contentValue->page_field_id] = $contentValue->id;
                });

            collect($contentDto->getValues())->each(function (ContentValueDto $valueDto) use ($contentValueIds, $contentDto) {
                $id = data_get($contentValueIds, [$valueDto->getLanguageId(), $valueDto->getPageFieldId()]);

                if ($id !== null) {
                    $this->repository->update(['value' => $valueDto->getValue()], $id);

                    return;
                }

                $contentDto = [
                    'language_id'   => $valueDto->getLanguageId(),
                    'content_id'    => $contentDto->getId(),
                    'page_field_id' => $valueDto->getPageFieldId(),
                    'value'         => $valueDto->getValue(),
                ];

                $this->repository->create($contentDto);
            });

            return true;

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
