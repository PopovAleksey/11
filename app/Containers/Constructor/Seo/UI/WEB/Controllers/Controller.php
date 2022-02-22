<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Seo\Actions\CreateSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\DeleteSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\GetAllSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\UpdateSeoActionInterface;
use App\Containers\Constructor\Seo\Models\SeoInterface;
use App\Containers\Constructor\Seo\UI\WEB\Requests\StoreSeoRequest;
use App\Containers\Constructor\Seo\UI\WEB\Requests\UpdateSeoRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Controller extends WebController
{
    public function __construct(
        private GetAllSeoActionInterface       $getAllSeoAction,
        private GetAllPagesActionInterface     $getAllPagesAction,
        private GetAllLanguagesActionInterface $getAllLanguagesAction,
        private CreateSeoActionInterface       $createSeoAction,
        private UpdateSeoActionInterface      $updateSeoAction,
        private DeleteSeoActionInterface      $deleteSeoAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $seoLinks  = $this->getAllSeoAction->run();
        $pages     = $this->getAllPagesAction->run(true);
        $languages = $this->getAllLanguagesAction->run()->reject(fn(LanguageDto $language) => $language->isActive() === false);
        $caseType  = [
            SeoInterface::CAMEL_CASE,
            SeoInterface::PASCAL_CASE,
            SeoInterface::SNAKE_CASE,
            SeoInterface::KEBAB_CASE,
        ];

        return view('constructor@seo::list', [
            'domain'    => config('app.url'),
            'list'      => $seoLinks,
            'pages'     => $pages,
            'languages' => $languages,
            'caseTypes'  => $caseType,
        ]);
    }

    public function store(StoreSeoRequest $request): JsonResponse
    {
        $seoId = $this->createSeoAction->run($request->mapped());

        return response()->json(['id' => $seoId])->setStatusCode(200);
    }

    public function update(int $id, UpdateSeoRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateSeoAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteSeoAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
