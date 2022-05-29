<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetListBaseTemplatesTask extends Task implements GetListBaseTemplatesTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $templateRepository)
    {
    }

    public function run(int $themeId, int $languageId = null): Collection
    {
        return $this->templateRepository->getBaseTemplates($themeId, $languageId)
            ->collect()
            ->map(static function (TemplateInterface $template) {
                return (new TemplateDto())
                    ->setId($template->id)
                    ->setName($template->name)
                    ->setThemeId($template->theme_id)
                    ->setCreateAt($template->created_at)
                    ->setUpdateAt($template->updated_at);
            });
    }
}
