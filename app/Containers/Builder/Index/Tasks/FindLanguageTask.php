<?php

namespace App\Containers\Builder\Index\Tasks;


use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindLanguageTask extends Task implements FindLanguageTaskInterface
{
    public function __construct(private LanguageRepositoryInterface $repository)
    {
    }

    /**
     * @param string|null $shortLangName
     * @return \App\Ship\Parents\Dto\LanguageDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(?string $shortLangName = null): LanguageDto
    {
        try {
            $condition = $shortLangName === null ? ['id' => 1] : ['short_name' => strtoupper($shortLangName)];

            /**
             * @var \App\Ship\Parents\Models\LanguageInterface $language
             */
            $language = $this->repository->findWhere(array_merge(['active' => true], $condition))->first();

            return (new LanguageDto())
                ->setId($language->id)
                ->setName($language->name)
                ->setShortName($language->short_name)
                ->setIsActive($language->active)
                ->setCreateAt($language->created_at)
                ->setUpdateAt($language->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
