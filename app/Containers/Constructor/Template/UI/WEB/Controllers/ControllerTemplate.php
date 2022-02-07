<?php

namespace App\Containers\Constructor\Template\UI\WEB\Controllers;

use App\Containers\Constructor\Template\Actions\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\UI\WEB\Requests\StoreTemplateRequest;
use App\Containers\Constructor\Template\UI\WEB\Requests\UpdateTemplateRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ControllerTemplate extends WebController
{
    public function __construct(
        private CreateTemplateActionInterface   $createTemplateAction,
        private FindTemplateByIdActionInterface $findTemplateByIdAction,
        private UpdateTemplateActionInterface   $updateTemplateAction,
        private DeleteTemplateActionInterface   $deleteTemplateAction,
    )
    {
    }

    public function store(StoreTemplateRequest $request): JsonResponse
    {
        $templateId = $this->createTemplateAction->run($request->mapped());

        return response()->json(['id' => $templateId])->setStatusCode(200);
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
