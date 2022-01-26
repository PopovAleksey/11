<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetPossibleLanguagesAction extends Action implements GetPossibleLanguagesActionInterface
{
    public function __construct(private GetAllLanguagesTaskInterface $allLanguagesTask)
    {
    }

    public function run(): Collection
    {
        $excludeLanguages = $this->allLanguagesTask->run()->map(static function (LanguageDto $languageDto){
            return $languageDto->getShortName();
        });

        return collect(config('constructor-language.countries'))
            ->whereNotIn('code', $excludeLanguages);
    }
}
