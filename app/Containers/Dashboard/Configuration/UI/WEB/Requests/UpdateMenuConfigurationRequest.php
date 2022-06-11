<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Dto\ConfigurationMenuItemDto;
use App\Ship\Parents\Requests\Request;

class UpdateMenuConfigurationRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'              => ['nullable', 'string'],
            'active'            => ['nullable', 'bool'],
            'template_id'       => ['required', 'integer'],
            'items'             => ['nullable', 'array'],
            'items.*.contentId' => ['required', 'integer'],
            'items.*.order'     => ['required', 'integer'],
        ];
    }

    public function mapped(): ConfigurationMenuDto
    {
        $data  = $this->validated();
        $order = 0;

        $items = collect(data_get($data, 'items'))
            ->map(static function (array $list) use (&$order) {
                $order++;

                return (new ConfigurationMenuItemDto())
                    ->setContentId(data_get($list, 'contentId'))
                    ->setOrder(data_get($list, 'order', $order));
            });

        return (new ConfigurationMenuDto())
            ->setName(data_get($data, 'name'))
            ->setActive(data_get($data, 'active', true))
            ->setTemplateId(data_get($data, 'template_id'))
            ->setItems($items);
    }
}
