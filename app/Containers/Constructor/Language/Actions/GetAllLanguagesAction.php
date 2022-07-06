<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LanguageDto;
use Illuminate\Support\Collection;

class GetAllLanguagesAction extends Action implements GetAllLanguagesActionInterface
{
    public function __construct(
        private readonly GetAllLanguagesTaskInterface $allLanguagesTask
    )
    {
    }

    public function run(bool $getOnlyActive = false): Collection
    {
        $list = $this->allLanguagesTask->run();

        if ($getOnlyActive === false) {
            return $list;
        }

        return $list->reject(fn(LanguageDto $languageDto) => $languageDto->isActive() === false);
    }
}
