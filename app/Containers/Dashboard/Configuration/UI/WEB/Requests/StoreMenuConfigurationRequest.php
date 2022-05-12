<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Requests\Request;

class StoreMenuConfigurationRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'active'      => ['nullable', 'boolean'],
            'template_id' => ['required', 'integer'],
        ];
    }

    public function mapped(): ConfigurationMenuDto
    {
        $validated = $this->validated();

        return (new ConfigurationMenuDto())
            ->setName(data_get($validated, 'name'))
            ->setActive(data_get($validated, 'active', true))
            ->setTemplateId(data_get($validated, 'template_id'));
    }
}
