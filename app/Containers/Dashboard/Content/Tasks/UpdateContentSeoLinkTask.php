<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Repositories\SeoLinkRepositoryInterface;
use App\Ship\Parents\Repositories\SeoRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Facade\FlareClient\Http\Exceptions\InvalidData;
use Illuminate\Support\Facades\DB;

class UpdateContentSeoLinkTask extends Task implements UpdateContentSeoLinkTaskInterface
{
    public function __construct(
        private SeoRepositoryInterface     $seoRepository,
        private SeoLinkRepositoryInterface $seoLinkRepository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ContentDto $data
     * @return void
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     * @throws \Throwable
     */
    public function run(ContentDto $data): void
    {
        try {
            DB::transaction(function () use ($data) {
                $currentLinks = $this->seoLinkRepository->findByField('content_id', $data->getId())->keyBy('seo_id');

                $this->seoRepository->findByField('page_id', $data->getPageId())
                    ->reject(fn(SeoInterface $seo) => $seo->active === false)
                    ->map(function (SeoInterface $seo) use ($data, $currentLinks) {
                        $seoLink = $data->getValues()
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

                        /**
                         * @var \App\Ship\Parents\Models\SeoLinkInterface|null $updateLink
                         */
                        $updateLink   = $currentLinks->get($seo->id);
                        $updateLinkId = $updateLink?->id;

                        if ($updateLinkId === null) {
                            $data = [
                                'seo_id'     => $seo->id,
                                'content_id' => $data->getId(),
                                'link'       => $seoLink,
                            ];

                            $this->seoLinkRepository->create($data);

                            return;
                        }

                        if ($seo->static === false) {
                            $this->seoLinkRepository->update(['link' => $seoLink], $updateLinkId);
                        }
                    });
            });
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }

    /**
     * @param \App\Ship\Parents\Models\SeoInterface $seo
     * @param string|null                           $fieldValue
     * @return string
     * @throws \Facade\FlareClient\Http\Exceptions\InvalidData
     */
    private function buildSeoLink(SeoInterface $seo, string|null $fieldValue): string
    {
        if ($fieldValue === null) {
            throw new InvalidData('You can\'t save content with field which uses for build SEO link!');
        }

        preg_replace('/[^A-Za-z\d\-]/', '', $fieldValue);
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
