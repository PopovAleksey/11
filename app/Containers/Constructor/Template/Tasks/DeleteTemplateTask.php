<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Storage;

class DeleteTemplateTask extends Task implements DeleteTemplateTaskInterface
{
    public function __construct(
        private ThemeRepositoryInterface    $themeRepository,
        private TemplateRepositoryInterface $templateRepository
    )
    {
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \App\Ship\Exceptions\DeleteResourceFailedException
     */
    public function run(int $id): ?bool
    {
        #try {
        /**
         * @var \App\Ship\Parents\Models\TemplateInterface $template
         */
        $template = $this->templateRepository->find($id);
        $theme    = $this->themeRepository->find($template->theme_id);

        $this->templateRepository->delete($template->id);

        $folder = match ($template->type) {
            TemplateInterface::CSS_TYPE => config('constructor-template.folderName.css'),
            TemplateInterface::JS_TYPE => config('constructor-template.folderName.js'),
            default => config('constructor-template.folderName.view'),
        };

        $path = implode('/', [$theme->directory, $folder]);

        Storage::disk('template')->delete($path . '/' . $template->common_filepath);
        Storage::disk('template')->delete($path . '/' . $template->element_filepath);
        Storage::disk('template')->delete($path . '/' . $template->preview_filepath);

        return true;
        /*} catch (Exception) {
            throw new DeleteResourceFailedException();
        }*/
    }
}
