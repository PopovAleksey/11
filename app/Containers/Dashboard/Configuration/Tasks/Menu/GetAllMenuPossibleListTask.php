<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ConfigurationMenuItemDto;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuPossibleListTask extends Task implements GetAllMenuPossibleListTaskInterface
{
    public function __construct(
        private readonly ConfigurationMenuRepositoryInterface $configurationMenuRepository,
        private readonly LanguageRepositoryInterface          $languageRepository
    )
    {
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(): Collection
    {
        /**
         * @var \App\Ship\Parents\Models\LanguageInterface|null $firstLanguage
         */
        $firstLanguage = $this->languageRepository->first();

        if ($firstLanguage === null) {
            throw new NotFoundException('Not found any language! Create one or more languages');
        }

        return $this->configurationMenuRepository
            ->getPossibleMenuItems($firstLanguage->id)
            ->groupBy('id')
            ->map(static function (Collection $configurationMenu) {
                /**
                 * @var ConfigurationMenuInterface $configurationMenu
                 */
                $configurationMenu = $configurationMenu->first();

                return (new ConfigurationMenuItemDto())
                    ->setContentId($configurationMenu->id)
                    ->setName($configurationMenu->name . ': ' . $configurationMenu->value);
            });
    }
}
