<?php

namespace App\Containers\Builder\Index\Tasks;


use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindLanguagesTask extends Task implements FindLanguagesTaskInterface
{
    public function __construct(
        private readonly LanguageRepositoryInterface            $languageRepository,
        private readonly ConfigurationCommonRepositoryInterface $configurationCommonRepository
    )
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
            if ($shortLangName === null) {
                /**
                 * @var ConfigurationCommonInterface|null $defaultLanguage
                 */
                $defaultLanguage = $this->configurationCommonRepository->findByField('config', ConfigurationCommonInterface::DEFAULT_LANGUAGE)->first();
                $condition       = ['id' => (int) ($defaultLanguage?->value ?: 1)];

            } else {
                $condition = ['short_name' => strtoupper($shortLangName)];
            }

            /**
             * @var \App\Ship\Parents\Models\LanguageInterface $language
             */
            $language = $this->languageRepository->findWhere(array_merge(['active' => true], $condition))->first();

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
