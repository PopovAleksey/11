<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Models\TemplateInterface;
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
        ])->implode(',');

        return [
            'type'        => ['required', 'in:' . $types],
            'theme_id'    => ['required', 'integer'],
            'page_id'     => ['required_if:templateType,' . TemplateInterface::PAGE_TYPE, 'integer'],
            'language_id' => ['integer', 'nullable'],
        ];
    }

    public function mapped(): TemplateDto
    {
        $pageDto     = (new PageDto())->setId($this->get('page_id'));
        $languageDto = (new LanguageDto())->setId($this->get('language_id'));
        $themeDto    = (new ThemeDto())->setId($this->get('theme_id'));

        return (new TemplateDto())
            ->setType($this->get('type'))
            ->setTheme($themeDto)
            ->setPage($pageDto)
            ->setLanguage($languageDto);
    }
}
