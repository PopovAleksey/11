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
        private ConfigurationMenuRepositoryInterface $configurationMenuRepository
    )
    {
    }

    /**
     * @param int $languageId
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId): Collection
    {
        try {
            return $this->configurationMenuRepository
                ->getLinkDataOfMenuItems($languageId)
                ->map(static function (ConfigurationMenuInterface $configurationMenu) {
                    $link = route('builder_index_page', [
                        'language' => strtolower($configurationMenu->short_name),
                        'seoLink'  => $configurationMenu->link,
                    ]);

                    return collect(['name' => $configurationMenu->value, 'link' => $link]);
                });

        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
