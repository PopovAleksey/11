<?php

namespace App\Containers\Constructor\Template\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\ActivateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\CreateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\DeleteThemeActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\FindThemeByIdActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\GetAllThemesActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\UpdateNameThemeActionInterface;
use App\Containers\Constructor\Template\UI\WEB\Requests\ActivateThemeRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\StoreThemeRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateNameThemeRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ControllerTheme extends WebController
{
    public function __construct(
        private readonly GetAllThemesActionInterface    $getAllThemesAction,
        private readonly CreateThemeActionInterface     $createThemeAction,
        private readonly FindThemeByIdActionInterface   $findThemeByIdAction,
        private readonly ActivateThemeActionInterface   $activateThemeAction,
        private readonly DeleteThemeActionInterface     $deleteThemeAction,
        private readonly GetAllPagesActionInterface     $getAllPagesAction,
        private readonly GetAllLanguagesActionInterface $getAllLanguagesAction,
        private readonly UpdateNameThemeActionInterface $updateNameThemeAction
    )
    {
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|View|Application
    {
        return view('constructor@template::list', [
            'list' => $this->getAllThemesAction->run(),
        ]);
    }


    /**
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\StoreThemeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreThemeRequest $request): JsonResponse
    {
        $id = $this->createThemeAction->run($request->mapped());

        return response()
            ->json(['id' => $id])
            ->setStatusCode(200);
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(int $id): Factory|View|Application
    {
        return view('constructor@template::editTheme', [
            'languages' => $this->getAllLanguagesAction->run(),
            'pages'     => $this->getAllPagesAction->run(),
            'theme'     => $this->findThemeByIdAction->run($id),
        ]);
    }


    /**
     * @param int                                                                       $id
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\ActivateThemeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(int $id, ActivateThemeRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $theme = $this->activateThemeAction->run($data);

        return response()
            ->json(['id' => $theme->getId()])
            ->setStatusCode(200);
    }

    /**
     * @param int                                                                         $id
     * @param \App\Containers\Constructor\Template\UI\WEB\Requests\UpdateNameThemeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateName(int $id, UpdateNameThemeRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateNameThemeAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->deleteThemeAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
