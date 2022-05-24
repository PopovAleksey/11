<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Exception\InvalidResourceException;

class CreateContentTask extends Task implements CreateContentTaskInterface
{
    public function __construct(
        private PageRepositoryInterface         $pageRepository,
        private ContentRepositoryInterface      $contentRepository,
        private ContentValueRepositoryInterface $contentValueRepository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ContentDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     * @throws \Throwable
     */
    public function run(ContentDto $data): int
    {
        try {
            return DB::transaction(function () use ($data) {
                /**
                 * @var \App\Ship\Parents\Models\PageInterface    $page
                 * @var \App\Ship\Parents\Models\ContentInterface $content
                 */
                $page = $this->pageRepository->find($data->getPageId());

                if ($page->parent_page_id !== null && $data->getParentContentId() === null) {
                    throw new InvalidResourceException('You cant\'t create child content without parent!');
                }

                $content = $this->contentRepository->create([
                    'page_id'           => $data->getPageId(),
                    'parent_content_id' => $data->getParentContentId(),
                ]);

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
            });
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}

