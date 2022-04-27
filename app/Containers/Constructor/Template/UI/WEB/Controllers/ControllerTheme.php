<?php

namespace App\Containers\Constructor\Template\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Template\Actions\ActivateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\CreateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteThemeActionInterface;
use App\Containers\Constructor\Template\Actions\FindThemeByIdActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllThemesActionInterface;
use App\Containers\Constructor\Template\UI\WEB\Requests\StoreThemeRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateThemeRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Models\TemplateInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ControllerTheme extends WebController
{
    public function __construct(
        private GetAllThemesActionInterface    $getAllThemesAction,
        private CreateThemeActionInterface     $createThemeAction,
        private FindThemeByIdActionInterface   $findThemeByIdAction,
        private ActivateThemeActionInterface   $activateThemeAction,
        private DeleteThemeActionInterface     $deleteThemeAction,
        private GetAllPagesActionInterface     $getAllPagesAction,
        private GetAllLanguagesActionInterface $getAllLanguagesAction
    )
    {
    }


    public function index(): Factory|View|Application
    {
        return view('constructor@template::list', [
            'list' => $this->getAllThemesAction->run(),
        ]);
    }


    public function store(StoreThemeRequest $request): JsonResponse
    {
        $id = $this->createThemeAction->run($request->mapped());

        return response()
            ->json(['id' => $id])
            ->setStatusCode(200);
    }


    public function edit(int $id): Factory|View|Application
    {
        $types = [
            TemplateInterface::PAGE_TYPE,
            TemplateInterface::BASE_TYPE,
            TemplateInterface::CSS_TYPE,
            TemplateInterface::JS_TYPE,
            TemplateInterface::MENU_TYPE,
        ];

        return view('constructor@template::editTheme', [
            'types'     => $types,
            'languages' => $this->getAllLanguagesAction->run(),
            'pages'     => $this->getAllPagesAction->run(),
            'theme'     => $this->findThemeByIdAction->run($id),
        ]);
    }


    public function activate(int $id, UpdateThemeRequest $request): JsonResponse
    {
        $data = $request->mapped()->setName(null)->setId($id);

        $theme = $this->activateThemeAction->run($data);

        return response()
            ->json(['id' => $theme->getId()])
            ->setStatusCode(200);
    }


    public function destroy(int $id): JsonResponse
    {
        $this->deleteThemeAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
