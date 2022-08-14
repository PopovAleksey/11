<?php

namespace App\Containers\Constructor\Template\UI\WEB\Controllers;

use App\Containers\Constructor\Localization\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllIncludableItemsActionInterface;
use App\Containers\Constructor\Template\Actions\GetListBaseTemplatesAction;
use App\Containers\Constructor\Template\Actions\Template\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Template\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Template\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\Template\UpdateNameTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Template\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\UI\WEB\Requests\StoreTemplateRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateNameTemplateRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateTemplateRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\TemplateWidgetInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ControllerTemplate extends WebController
{
    public function __construct(
        private readonly GetAllIncludableItemsActionInterface $getAllIncludableItemsAction,
        private readonly GetAllLocalizationsActionInterface   $getAllLocalizationsAction,
        private readonly GetAllLanguagesActionInterface       $getAllLanguagesAction,
        private readonly GetListBaseTemplatesAction           $getListBaseTemplatesAction,
        private readonly CreateTemplateActionInterface        $createTemplateAction,
        private readonly FindTemplateByIdActionInterface      $findTemplateByIdAction,
        private readonly UpdateTemplateActionInterface        $updateTemplateAction,
        private readonly DeleteTemplateActionInterface        $deleteTemplateAction,
        private readonly UpdateNameTemplateActionInterface    $updateNameTemplateAction
    )
    {
    }


    /**
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\StoreTemplateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTemplateRequest $request): JsonResponse
    {
        return response()
            ->json(['id' => $this->createTemplateAction->run($request->mapped())])
            ->setStatusCode(200);
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $template         = $this->findTemplateByIdAction->run($id);
        $languageList     = $this->getAllLanguagesAction->run();
        $localizationList = $this->getAllLocalizationsAction->run();

        $view = match ($template->getType()) {
            TemplateInterface::MENU_TYPE, TemplateInterface::WIDGET_TYPE => 'constructor@template::editTemplateMenu',
            default => 'constructor@template::editTemplateSimple'
        };

        if ($template->getType() === TemplateInterface::PAGE_TYPE && $template->getChildPageId() !== null) {
            $view = 'constructor@template::editTemplateComposite';
        }

        /**
         * @var \App\Ship\Parents\Dto\LanguageDto|null $defaultLanguage
         */
        $defaultLanguage = $languageList->first();

        $localizationList = $localizationList
            ->get($defaultLanguage?->getId())
            ?->filter(fn(LocalizationDto $localizationDto) => in_array($localizationDto->getThemeId(), [$template->getThemeId(), null], true));

        $data = [
            'template'         => $template,
            'languages'        => $languageList,
            'localizationList' => $localizationList,
        ];

        if (in_array($template->getType(), [TemplateInterface::BASE_TYPE, TemplateInterface::PAGE_TYPE, TemplateInterface::MENU_TYPE], true)) {
            $includableItems = $this->getAllIncludableItemsAction->run($template->getThemeId());
            $data            = array_merge($data, ['includableItems' => $includableItems]);
        }

        if ($template->getType() === TemplateInterface::PAGE_TYPE) {
            $listOfBaseTemplates = $this->getListBaseTemplatesAction->run($template->getThemeId(), $template->getLanguageId());
            $data                = array_merge($data, ['baseTemplates' => $listOfBaseTemplates]);
        }

        if ($template->getType() === TemplateInterface::WIDGET_TYPE) {
            $listShowBy = [
                TemplateWidgetInterface::SHOW_FIRST,
                TemplateWidgetInterface::SHOW_LAST,
                TemplateWidgetInterface::SHOW_RANDOM,
            ];
            $data       = array_merge($data, ['listShowBy' => $listShowBy]);
        }

        return view($view, $data);
    }


    /**
     * @param int                                                                        $id
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\UpdateTemplateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, UpdateTemplateRequest $request): JsonResponse
    {
        $data   = $request->mapped()->setId($id);
        $widget = $data->getWidget()?->setTemplateId($id);
        $data->setWidget($widget);

        $template = $this->updateTemplateAction->run($data);

        return response()
            ->json(['id' => $template->getId()])
            ->setStatusCode(200);
    }

    /**
     * @param int                                                                            $id
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\UpdateNameTemplateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateName(int $id, UpdateNameTemplateRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);
        $this->updateNameTemplateAction->run($data);

        return response()->json()->setStatusCode(200);
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->deleteTemplateAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
