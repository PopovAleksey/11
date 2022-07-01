<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class FindMenuItemsTask extends Task implements FindMenuItemsTaskInterface
{
    public function __construct(
        private readonly ConfigurationMenuRepositoryInterface $configurationMenuRepository
    )
    {
    }

    /**
     * @param int                                  $languageId
     * @param int                                  $themeId
     * @param array|\Illuminate\Support\Collection $menuIds
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId, int $themeId, array|Collection $menuIds): Collection
    {
        try {
            return $this->configurationMenuRepository
                ->getLinkDataOfMenuItems($languageId, $themeId, $menuIds)
                ->map(static function (ConfigurationMenuInterface $configurationMenu) {
                    $link = route('builder_index_page', [
                        'language' => strtolower($configurationMenu->short_name),
                        'seoLink'  => $configurationMenu->active === true ? $configurationMenu->link ?? $configurationMenu->content_id : $configurationMenu->content_id,
                    ]);

                    return collect([
                        'template_id' => $configurationMenu->template_id,
                        'menu_id'     => $configurationMenu->id,
                        'name'        => $configurationMenu->value,
                        'link'        => $link,
                    ]);
                })->groupBy('menu_id');

        } catch (Exception $exception) {
            throw new NotFoundException($exception->getMessage());
        }
    }
}
