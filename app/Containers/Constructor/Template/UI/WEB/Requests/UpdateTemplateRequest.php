<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\TemplateWidgetDto;
use App\Ship\Parents\Requests\Request;

class UpdateTemplateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'               => ['string'],
            'parent_template_id' => ['integer'],
            'commonHtml'         => ['required', 'string', 'nullable'],
            'elementHtml'        => ['string', 'nullable'],
            'previewHtml'        => ['string', 'nullable'],
            'widget'             => ['array', 'nullable'],
            'widget.count'       => ['integer', 'nullable'],
            'widget.show_by'     => ['string', 'nullable'],
        ];
    }

    public function mapped(): TemplateDto
    {
        $validated = $this->validated();

        $templateDto = (new TemplateDto())
            ->setName(data_get($validated, 'name'))
            ->setParentTemplateId(data_get($validated, 'parent_template_id'))
            ->setCommonHtml(data_get($validated, 'commonHtml'))
            ->setElementHtml(data_get($validated, 'elementHtml'))
            ->setPreviewHtml(data_get($validated, 'previewHtml'));

        $widgetCount = data_get($validated, ['widget', 'count']);
        $widgetShow  = data_get($validated, ['widget', 'show_by']);

        if ($widgetCount !== null || $widgetShow !== null) {
            $widget = (new TemplateWidgetDto())
                ->setCountElements(data_get($validated, ['widget', 'count']))
                ->setShowBy(data_get($validated, ['widget', 'show_by']));

            return $templateDto->setWidget($widget);
        }

        return $templateDto;
    }
}
