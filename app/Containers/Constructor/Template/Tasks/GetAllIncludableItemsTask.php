<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllIncludableItemsTask extends Task implements GetAllIncludableItemsTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    public function run(int $themeId): Collection
    {
        return $this->repository
            ->getIncludableItemsByTheme($themeId)
            ->collect()
            ->map(static function (TemplateInterface $template) {
                $language = (new LanguageDto())
                    ->setId($template->language_id)
                    ->setName($template->language_name);

                return (new TemplateDto())
                    ->setId($template->id)
                    ->setType($template->type)
                    ->setName($template->name)
                    ->setThemeId($template->theme_id)
                    ->setLanguageId($template->language_id)
                    ->setLanguage($language)
                    ->setCommonFilepath($template->common_filepath)
                    ->setElementFilepath($template->element_filepath)
                    ->setPreviewFilepath($template->preview_filepath)
                    ->setCreateAt($template->created_at)
                    ->setUpdateAt($template->updated_at);
            })->groupBy(fn(TemplateDto $templateDto) => $templateDto->getType());
    }
}
