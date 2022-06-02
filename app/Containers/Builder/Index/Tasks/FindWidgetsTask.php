<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\TemplateWidgetDto;
use App\Ship\Parents\Models\TemplateWidgetInterface;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\TemplateWidgetRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class FindWidgetsTask extends Task implements FindWidgetsTaskInterface
{
    public function __construct(
        private ContentRepositoryInterface        $contentRepository,
        private TemplateWidgetRepositoryInterface $templateWidgetRepository
    )
    {
    }

    /**
     * @param int                            $languageId
     * @param \Illuminate\Support\Collection $widgetsIds
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId, Collection $widgetsIds): Collection
    {
        try {
            return $this->templateWidgetRepository
                ->findWhereIn('template_id', $widgetsIds->toArray())
                ->collect()
                ->map(function (TemplateWidgetInterface $templateWidget) use ($languageId) {
                    $pageId     = $templateWidget->template->page_id;
                    $contentIds = $this->contentRepository->getFewContentIds($pageId, $templateWidget->count_elements, $templateWidget->show_by)->collect();
                    $contents   = $this->templateWidgetRepository
                        ->getWidgetContents($templateWidget->template_id, $languageId, $contentIds)->collect()
                        ->groupBy(fn(TemplateWidgetInterface $templateWidget) => $templateWidget->content_id)
                        ->map(static function (Collection $contentValues) {

                            $values = $contentValues->map(static function (TemplateWidgetInterface $templateWidget) {
                                return (new ContentValueDto())
                                    ->setContentId($templateWidget->content_id)
                                    ->setPageFieldId($templateWidget->page_field_id)
                                    ->setValue($templateWidget->value)
                                    ->setLanguageId($templateWidget->language_id);
                            });

                            /**
                             * @var TemplateWidgetInterface $content
                             */
                            $content = $contentValues->first();
                            #@TODO Need move it to Seo module and replace save code. Clean copypast code.
                            $link    = route('builder_index_page', [
                                'language' => strtolower($content->short_name),
                                'seoLink'  => $content->seo_active === true ? ($content?->link ?? (string) $content->content_id) : $content->content_id,
                            ]);

                            return (new ContentDto())
                                ->setId($content->content_id)
                                ->setLink($link)
                                ->setValues($values)
                                ->setPageId($content->page_id);
                        });

                    return (new TemplateWidgetDto())
                        ->setId($templateWidget->id)
                        ->setTemplateId($templateWidget->template_id)
                        ->setCountElements($templateWidget->count_elements)
                        ->setShowBy($templateWidget->show_by)
                        ->setContents($contents)
                        ->setCreateAt($templateWidget->created_at)
                        ->setUpdateAt($templateWidget->updated_at);
                });
        } catch (Exception $exception) {
            throw new NotFoundException($exception->getMessage());
        }
    }
}
