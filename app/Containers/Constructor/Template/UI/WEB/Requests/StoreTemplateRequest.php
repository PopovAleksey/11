<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Requests\Request;

class StoreTemplateRequest extends Request
{
    public function rules(): array
    {
        $types = collect([
            TemplateInterface::PAGE_TYPE,
            TemplateInterface::BASE_TYPE,
            TemplateInterface::CSS_TYPE,
            TemplateInterface::JS_TYPE,
            TemplateInterface::MENU_TYPE,
            TemplateInterface::WIDGET_TYPE,
        ])->implode(',');

        return [
            'type'        => ['required', 'in:' . $types],
            'name'        => ['nullable', 'string'],
            'theme_id'    => ['required', 'integer'],
            'page_id'     => ['required_if:type,' . TemplateInterface::PAGE_TYPE, 'integer'],
            'parent_id'   => ['required_if:type,' . TemplateInterface::PAGE_TYPE . ',' . TemplateInterface::WIDGET_TYPE, 'integer'],
            'language_id' => ['integer', 'nullable'],
        ];
    }

    public function mapped(): TemplateDto
    {
        $pageDto     = (new PageDto())->setId($this->get('page_id'));
        $languageDto = (new LanguageDto())->setId($this->get('language_id'));
        $themeDto    = (new ThemeDto())->setId($this->get('theme_id'));
        $templateDto = (new TemplateDto())->setId($this->get('parent_id'));

        $data = $this->validated();

        return (new TemplateDto())
            ->setType(data_get($data, 'type'))
            ->setName(data_get($data, 'name'))
            ->setTheme($themeDto)
            ->setThemeId($this->get('theme_id'))
            ->setPage($pageDto)
            ->setPageId($this->get('page_id'))
            ->setLanguage($languageDto)
            ->setLanguageId($this->get('language_id'))
            ->setTemplate($templateDto)
            ->setParentTemplateId($this->get('parent_id'));
    }
}
