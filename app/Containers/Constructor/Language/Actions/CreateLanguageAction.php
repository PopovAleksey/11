<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\CreateLanguageTaskInterface;
use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTaskInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LanguageDto;

class CreateLanguageAction extends Action implements CreateLanguageActionInterface
{
    public function __construct(
        private CreateLanguageTaskInterface  $createLanguageTask,
        private GetAllLanguagesTaskInterface $allLanguagesTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LanguageDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(LanguageDto $data): bool
    {
        $findLanguage = collect(config('constructor-language.countries'))
            ->where('code', $data->getShortName());

        if ($findLanguage->isEmpty()) {
            throw new NotFoundException('Incorrect Language code!');
        }

        $this->allLanguagesTask->run()->each(static function (LanguageDto $languageDto) use ($data) {
            if ($languageDto->getShortName() === $data->getShortName()) {
                throw new CreateResourceFailedException('Language is exists!');
            }
        });

        $data->setName(data_get($findLanguage->first(), 'name'));

        $this->createLanguageTask->run($data);

        return true;
    }
}
