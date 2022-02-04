<?php

namespace App\Containers\Constructor\Template\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Template\Actions\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllTemplatesActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\UI\WEB\Requests\StoreTemplateRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateTemplateRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Controller extends WebController
{
    public function __construct(
        private GetAllTemplatesActionInterface     $getAllTemplatesAction,
        private CreateTemplateActionInterface      $createTemplateAction,
        private FindTemplateByIdActionInterface    $findTemplateByIdAction,
        private UpdateTemplateActionInterface      $updateTemplateAction,
        private DeleteTemplateActionInterface      $deleteTemplateAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $templates = $this->getAllTemplatesAction->run();

        dd(callAction('Constructor', 'Page', 'sGetAllPagesActionInterface'));
        dd(app('App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface')->run());
        return view('constructor.base');
    }

    public function show(int $id): Factory|View|Application
    {
        $template = $this->findTemplateByIdAction->run($id);

        return view('constructor.base');
    }

    public function create(): Factory|View|Application
    {
        return view('constructor.base');
    }

    public function store(StoreTemplateRequest $request): JsonResponse
    {
        $this->createTemplateAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }

    public function edit(int $id): Factory|View|Application
    {
        $template = $this->findTemplateByIdAction->run($id);

        return view('constructor.base');
    }

    public function update(int $id, UpdateTemplateRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateTemplateAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteTemplateAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
