<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Repositories\SeoLinkRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class FindContentsTask extends Task implements FindContentsTaskInterface
{
    public function __construct(
        private ContentRepositoryInterface      $contentRepository,
        private ContentValueRepositoryInterface $contentValueRepository,
        private SeoLinkRepositoryInterface      $seoLinkRepository,
        private LanguageRepositoryInterface     $languageRepository
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
            $contentValues = $this->contentValueRepository->getContentValuesByLanguageAndSeoLink($languageId, $seoLink);

            if ($contentValues->isEmpty()) {
                throw new NotFoundException();
            }

            /**
             * @var \App\Ship\Parents\Models\ContentInterface  $content
             * @var \App\Ship\Parents\Models\LanguageInterface $language
             */
            $content       = $this->contentRepository->find($contentValues->first()->content_id);
            $language      = $this->languageRepository->find($languageId);
            $contentValues = $this->buildContentValuesDto($contentValues);
            $contentDto    = $this->buildContentDto($content)->setValues($contentValues);
            $childContent  = $content->child_content;

            if ($childContent->count() === 0) {
                return $contentDto;
            }

            $childContentIds    = $childContent->keyBy('id')->keys();
            $childContentValues = $this->contentValueRepository
                ->getContentValuesByLanguageAndIds($languageId, $childContentIds->toArray())
                ->groupBy('content_id');
            $childContentLinks  = $this->seoLinkRepository
                ->getLinksByLanguageAndContentIds($languageId, $childContentIds->toArray())
                ->groupBy('content_id');

            $childContentList = $childContent->map(
                function (ContentInterface $content) use ($language, $childContentValues, $childContentLinks) {
                    /**
                     * @var null|\App\Ship\Parents\Models\SeoLinkInterface $contentLink
                     */
                    $childContentValuesList = $childContentValues->get($content->id);
                    $contentLink            = $childContentLinks->get($content->id)?->first();
                    $childContentValues     = $this->buildContentValuesDto($childContentValuesList ?? collect());
                    $link                   = route('builder_index_page', [
                        'language' => strtolower($language->short_name),
                        'seoLink'  => $contentLink?->link ?? $content->id,
                    ]);

                    return $this->buildContentDto($content)
                        ->setValues($childContentValues)
                        ->setLink($link);
                }
            );

            return $contentDto->setChildContent($childContentList);

        } catch (Exception $exception) {
            throw new NotFoundException($exception->getMessage());
        }
    }

    /**
     * @param \Illuminate\Support\Collection $contentValue
     * @return \Illuminate\Support\Collection
     */
    private function buildContentValuesDto(Collection $contentValue): Collection
    {
        return $contentValue
            ->map(static function (ContentValueInterface $contentValue) {
                return (new ContentValueDto())
                    ->setId($contentValue->id)
                    ->setLanguageId($contentValue->language_id)
                    ->setContentId($contentValue->content_id)
                    ->setValue($contentValue->value)
                    ->setPageFieldId($contentValue->page_field_id)
                    ->setCreateAt($contentValue->created_at)
                    ->setUpdateAt($contentValue->updated_at);
            })
            ->values();
    }

    /**
     * @param \App\Ship\Parents\Models\ContentInterface $content
     * @return \App\Ship\Parents\Dto\ContentDto
     */
    private function buildContentDto(ContentInterface $content): ContentDto
    {
        return (new ContentDto())
            ->setId($content->id)
            ->setPageId($content->page_id)
            ->setParentContentId($content->parent_content_id)
            ->setActive($content->active)
            ->setCreateAt($content->created_at)
            ->setUpdateAt($content->updated_at);
    }
}
