<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\UpdateLanguageTaskInterface;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LanguageDto;

class UpdateLanguageAction extends Action implements UpdateLanguageActionInterface
{
    public function __construct(private UpdateLanguageTaskInterface $languageTask)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LanguageDto $data
     * @return void
     * @throws \App\Ship\Exceptions\ValidationFailedException
     */
    public function run(LanguageDto $data): void
    {
        if ($data->getId() === null) {
            throw new ValidationFailedException();
        }

        $this->languageTask->run($data);
    }
}
