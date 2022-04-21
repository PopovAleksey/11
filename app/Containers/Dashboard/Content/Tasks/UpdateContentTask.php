<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Dto\ContentValueDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentValueRepositoryInterface;
use App\Containers\Dashboard\Content\Models\ContentValueInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateContentTask extends Task implements UpdateContentTaskInterface
{
    public function __construct(private ContentValueRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Dashboard\Content\Data\Dto\ContentDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ContentDto $data): bool
    {
        try {
            $contentValueIds = [];
            $this->repository
                ->findByField('content_id', $data->getId())
                ->each(static function (ContentValueInterface $contentValue) use (&$contentValueIds) {
                    $contentValueIds[$contentValue->language_id][$contentValue->page_field_id] = $contentValue->id;
                });

            collect($data->getValues())->each(function (ContentValueDto $valueDto) use ($contentValueIds) {
                $id = data_get($contentValueIds, [$valueDto->getLanguageId(), $valueDto->getPageFieldId()]);

                if ($id !== null) {
                    $this->repository->update(['value' => $valueDto->getValue()], $id);
                }
            });

            return true;

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
