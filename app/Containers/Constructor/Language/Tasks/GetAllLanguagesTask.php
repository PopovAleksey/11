<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Models\Language;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllLanguagesTask extends Task implements GetAllLanguagesTaskInterface
{
    public function __construct(
        private readonly LanguageRepositoryInterface $repository
    )
    {
    }

    /**
     * @return \Illuminate\Support\Collection[LanguageDto]
     */
    public function run(): Collection
    {
        return $this->repository->all()->collect()->map(static function (Language $language) {
            return (new LanguageDto())
                ->setId($language->id)
                ->setName($language->name)
                ->setShortName($language->short_name)
                ->setIsActive($language->active)
                ->setCreateAt($language->created_at)
                ->setUpdateAt($language->updated_at);
        });
    }
}
