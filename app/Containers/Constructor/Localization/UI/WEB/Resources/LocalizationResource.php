<?php

namespace App\Containers\Constructor\Localization\UI\WEB\Resources;

use App\Ship\Parents\Dto\LocalizationValueDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read \App\Ship\Parents\Dto\LocalizationDto $resource
 */
class LocalizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = $this->resource;

        $values = $data
            ->getValues()
            ?->map(static function (LocalizationValueDto $localizationValueDto) {
                return [
                    'id'          => $localizationValueDto->getId(),
                    'language_id' => $localizationValueDto->getLanguageId(),
                    'value'       => $localizationValueDto->getValue(),
                    'created_at'  => $localizationValueDto->getCreateAt(),
                    'updated_at'  => $localizationValueDto->getUpdateAt(),
                ];
            })
            ->toArray();

        return [
            'id'         => $data->getId(),
            'point'      => $data->getPoint(),
            'values'     => $values,
            'theme_id'   => $data->getThemeId(),
            'created_at' => $data->getCreateAt(),
            'updated_at' => $data->getUpdateAt(),
        ];
    }
}
