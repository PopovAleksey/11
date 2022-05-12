<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Collection;

class UpdateMenuConfigurationRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'              => ['nullable', 'string'],
            'active'            => ['nullable', 'bool'],
            'template_id'       => ['required', 'integer'],
            'items'             => ['required', 'array'],
            'items.*.contentId' => ['required', 'integer'],
            'items.*.order'     => ['required', 'integer'],
        ];
    }

    public function mapped(): Collection
    {
        $data  = $this->validated();
        $order = 0;

        return collect(data_get($data, 'list'))
            ->map(static function (array $list) use (&$order) {
                $order++;

                return (new ConfigurationMenuDto())
                    ->setContentId(data_get($list, 'contentId'))
                    ->setOrder(data_get($list, 'order', $order));
            });
    }
}
