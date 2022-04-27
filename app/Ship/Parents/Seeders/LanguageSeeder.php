<?php

namespace App\Ship\Parents\Seeders;

use App\Containers\Constructor\Language\Tasks\CreateLanguageTaskInterface;
use App\Ship\Parents\Dto\LanguageDto;

class LanguageSeeder extends Seeder
{
    public function __construct(private CreateLanguageTaskInterface $createLanguageTask)
    {
    }

    public function run(): void
    {
        $enabled    = ['US', 'UA'];
        $additional = ['RU'];

        collect(config('constructor-language.countries'))
            ->whereIn('code', array_merge($enabled, $additional))
            ->sortDesc()
            ->each(function ($country) use ($enabled) {
                $name        = data_get($country, 'name');
                $code        = data_get($country, 'code');
                $languageDto = (new LanguageDto())
                    ->setName($name)
                    ->setShortName($code)
                    ->setIsActive(in_array($code, $enabled, true));

                $this->createLanguageTask->run($languageDto);
            });
    }
}
