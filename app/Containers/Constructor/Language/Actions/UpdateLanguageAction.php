<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Language\Tasks\UpdateLanguageTaskInterface;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Actions\Action;

class UpdateLanguageAction extends Action implements UpdateLanguageActionInterface
{
    public function __construct(private UpdateLanguageTaskInterface $languageTask)
    {
    }

    /**
     * @param \App\Containers\Constructor\Language\Data\Dto\LanguageDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\ValidationFailedException
     */
    public function run(LanguageDto $data): bool
    {
        if ($data->getId() === NULL) {
            throw new ValidationFailedException();
        }

        $this->languageTask->run($data);

        return true;
    }
}
