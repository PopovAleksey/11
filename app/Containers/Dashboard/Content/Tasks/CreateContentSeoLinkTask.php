<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Constructor\Seo\Data\Repositories\SeoLinkRepositoryInterface;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Containers\Constructor\Seo\Models\SeoInterface;
use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Dto\ContentValueDto;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Facade\FlareClient\Http\Exceptions\InvalidData;

class CreateContentSeoLinkTask extends Task implements CreateContentSeoLinkTaskInterface
{
    public function __construct(
        private SeoRepositoryInterface     $seoRepository,
        private SeoLinkRepositoryInterface $seoLinkRepository
    )
    {
    }

    /**
     * @param \App\Containers\Dashboard\Content\Data\Dto\ContentDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(ContentDto $data): bool
    {
        try {
            $this->seoRepository
                ->findByField('page_id', $data->getPageId())
                ->reject(fn(SeoInterface $seo) => $seo->active === false)
                ->each(function (SeoInterface $seo) use ($data) {
                    $seoLink = collect($data->getValues())
                        ->map(function (ContentValueDto $contentValueDto) use ($seo) {
                            if (
                                $seo->language_id === $contentValueDto->getLanguageId() &&
                                $seo->page_field_id === $contentValueDto->getPageFieldId()
                            ) {
                                return $this->buildSeoLink($seo, $contentValueDto->getValue());
                            }

                            return null;
                        })
                        ->reject(fn($link) => $link === null)
                        ->first();

                    $data = [
                        'seo_id'     => $seo->id,
                        'content_id' => $data->getId(),
                        'link'       => $seoLink,
                    ];

                    $this->seoLinkRepository->create($data);
                });

            return true;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }

    /**
     * @param \App\Containers\Constructor\Seo\Models\SeoInterface $seo
     * @param string|null                                         $fieldValue
     * @return string
     * @throws \Facade\FlareClient\Http\Exceptions\InvalidData
     */
    private function buildSeoLink(SeoInterface $seo, string|null $fieldValue): string
    {
        if ($fieldValue === null) {
            throw new InvalidData('You can\'t save content with field which uses for build SEO link!');
        }

        preg_replace('/[^A-Za-z0-9\-]/', '', $fieldValue);
        $fieldValue = strtolower($this->toLatin($fieldValue));

        return match ($seo->case_type) {
            SeoInterface::CAMEL_CASE => lcfirst(str_replace(' ', '', ucwords($fieldValue))),
            SeoInterface::KEBAB_CASE => str_replace(' ', '-', $fieldValue),
            SeoInterface::PASCAL_CASE => str_replace(' ', '', ucwords($fieldValue)),
            SeoInterface::SNAKE_CASE => str_replace(' ', '_', $fieldValue)
        };
    }

    /**
     * @param string $string
     * @return string
     */
    private function toLatin(string $string): string
    {
        $chars = [
            "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d",
            "е" => "e", "ё" => "yo", "ж" => "j", "з" => "z", "и" => "ii",
            "й" => "ji", "к" => "k", "л" => "l", "м" => "m", "н" => "n",
            "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t",
            "у" => "y", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch",
            "ш" => "sh", "щ" => "sch", "ы" => "ie", "э" => "e", "ю" => "u",
            "я" => "ya",
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D",
            "Е" => "E", "Ё" => "Yo", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Ji", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "Y", "Ф" => "F", "Х" => "H", "Ц" => "C", "Ч" => "Ch",
            "Ш" => "Sh", "Щ" => "Sch", "Ы" => "Ie", "Э" => "E", "Ю" => "U",
            "Я" => "Ya",
            "ь" => "'", "Ь" => "_'", "ъ" => "''", "Ъ" => "_''",
            "ї" => "yi",
            "і" => "ii",
            "ґ" => "ge",
            "є" => "ye",
            "Ї" => "Yi",
            "І" => "II",
            "Ґ" => "Ge",
            "Є" => "YE",
        ];

        return strtr($string, $chars);
    }
}

