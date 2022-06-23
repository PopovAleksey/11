<?php

namespace App\Containers\Constructor\Localization\UI\API\Transformers;

use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Transformers\Transformer;

class FindLocalizationTransformer extends Transformer
{
    public function transform(LocalizationDto $localizationDto): array
    {
        $values = $localizationDto->getValues()
            ?->map(static function (LocalizationValueDto $localizationValueDto) {
                return [
                    'id'          => $localizationValueDto->getId(),
                    'language_id' => $localizationValueDto->getLanguageId(),
                    'value'       => $localizationValueDto->getValue(),
                    'created_at'  => $localizationValueDto->getCreateAt(),
                    'updated_at'  => $localizationValueDto->getUpdateAt(),
                ];
            })->toArray();

        return [
            'id'         => $localizationDto->getId(),
            'theme_id'   => $localizationDto->getThemeId(),
            'point'      => $localizationDto->getPoint(),
            'values'     => $values,
            'created_at' => $localizationDto->getCreateAt(),
            'updated_at' => $localizationDto->getUpdateAt(),

        ];
    }
}
