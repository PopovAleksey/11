<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Containers\Dashboard\Configuration\Data\Dto\MenuDto;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Collection;

class UpdateMenuConfigurationRequest extends Request
{
    public function rules(): array
    {
        return [
            'list'             => ['required', 'array'],
            'list.*.contentId' => ['required', 'integer'],
            'list.*.order'     => ['required', 'integer'],
        ];
    }

    public function mapped(): Collection
    {
        $data  = $this->validated();
        $order = 0;

        return collect(data_get($data, 'list'))
            ->map(static function (array $list) use (&$order) {
                $order++;

                return (new MenuDto())
                    ->setContentId(data_get($list, 'contentId'))
                    ->setOrder(data_get($list, 'order', $order));
            });
    }
}
