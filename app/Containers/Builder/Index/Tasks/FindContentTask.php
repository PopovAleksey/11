<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\SeoLinkRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class FindContentTask extends Task implements FindContentTaskInterface
{
    public function __construct(
        private SeoLinkRepositoryInterface $seoLinkRepository,
        private ContentRepositoryInterface $contentRepository
    )
    {
    }

    /**
     * @param int         $languageId
     * @param string|null $seoLink
     * @return \App\Ship\Parents\Dto\ContentDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId, ?string $seoLink): ContentDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\SeoLinkInterface $seoLink
             */
            $seoLink       = $this->seoLinkRepository->findWhere(['link' => $seoLink])->first();
            $seoLanguageId = $seoLink->seo->language_id;

            if ($seoLanguageId !== $languageId) {
                throw new NotFoundException();
            }

            /**
             * @var \App\Ship\Parents\Models\ContentInterface $content
             */
            $content = $this->contentRepository->find($seoLink->content_id);

            if ($content->active === false) {
                throw new NotFoundException();
            }

            $contentValues = $this->buildContentValuesDto($content->values, $seoLanguageId);

            return (new ContentDto())
                ->setId($content->id)
                ->setPageId($content->page_id)
                ->setActive($content->active)
                ->setValues($contentValues)
                ->setCreateAt($content->created_at)
                ->setUpdateAt($content->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $contentValue
     * @param int                                      $validLanguageId
     * @return \Illuminate\Support\Collection
     */
    private function buildContentValuesDto(Collection $contentValue, int $validLanguageId): \Illuminate\Support\Collection
    {
        return $contentValue
            ->map(static function (ContentValueInterface $contentValue) use ($validLanguageId) {
                if ($contentValue->language_id !== $validLanguageId) {
                    return null;
                }

                return (new ContentValueDto())
                    ->setId($contentValue->id)
                    ->setLanguageId($contentValue->language_id)
                    ->setContentId($contentValue->content_id)
                    ->setValue($contentValue->value)
                    ->setPageFieldId($contentValue->page_field_id)
                    ->setCreateAt($contentValue->created_at)
                    ->setUpdateAt($contentValue->updated_at);
            })
            ->filter(fn($item) => $item instanceof ContentValueDto)
            ->values();
    }
}
