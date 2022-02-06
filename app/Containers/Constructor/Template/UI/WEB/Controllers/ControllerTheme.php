<?php

namespace App\Containers\Constructor\Template\UI\WEB\Controllers;

use App\Containers\Constructor\Template\Actions\ActivateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\CreateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteThemeActionInterface;
use App\Containers\Constructor\Template\Actions\FindThemeByIdActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllThemesActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateThemeActionInterface;
use App\Containers\Constructor\Template\UI\WEB\Requests\StoreTemplateRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateTemplateRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateThemeRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ControllerTheme extends WebController
{
    public function __construct(
        private GetAllThemesActionInterface  $getAllThemesAction,
        private CreateThemeActionInterface   $createThemeAction,
        private FindThemeByIdActionInterface $findThemeByIdAction,
        private UpdateThemeActionInterface   $updateThemeAction,
        private ActivateThemeActionInterface $activateThemeAction,
        private DeleteThemeActionInterface   $deleteThemeAction
    )
    {
    }

    public function index(): Factory|View|Application
    {

        //callAction('Constructor@Page::GetAllPagesActionInterface'),

        return view('constructor@template::list', [
            'list' => $this->getAllThemesAction->run(),
        ]);
    }

    public function store(StoreTemplateRequest $request): JsonResponse
    {
        $this->createThemeAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }

    public function edit(int $id): Factory|View|Application
    {
        $template = $this->findThemeByIdAction->run($id);

        return view('constructor.base');
    }

    public function update(int $id, UpdateTemplateRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateThemeAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    /**
     * @param int                                                                     $id
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\UpdateThemeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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
