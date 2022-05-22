<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Seo\Actions\CreateSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\DeleteSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\GetAllSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\UpdateSeoActionInterface;
use App\Containers\Constructor\Seo\UI\WEB\Requests\StoreSeoRequest;
use App\Containers\Constructor\Seo\UI\WEB\Requests\UpdateSeoRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Models\SeoInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Controller extends WebController
{
    /**
     * @param \App\Containers\Constructor\Seo\Actions\GetAllSeoActionInterface            $getAllSeoAction
     * @param \App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface         $getAllPagesAction
     * @param \App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface $getAllLanguagesAction
     * @param \App\Containers\Constructor\Seo\Actions\CreateSeoActionInterface            $createSeoAction
     * @param \App\Containers\Constructor\Seo\Actions\UpdateSeoActionInterface            $updateSeoAction
     * @param \App\Containers\Constructor\Seo\Actions\DeleteSeoActionInterface            $deleteSeoAction
     */
    public function __construct(
        private GetAllSeoActionInterface       $getAllSeoAction,
        private GetAllPagesActionInterface     $getAllPagesAction,
        private GetAllLanguagesActionInterface $getAllLanguagesAction,
        private CreateSeoActionInterface       $createSeoAction,
        private UpdateSeoActionInterface       $updateSeoAction,
        private DeleteSeoActionInterface       $deleteSeoAction
    )
    {
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
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
            'caseTypes' => $caseType,
        ]);
    }


    /**
     * @param \App\Containers\Constructor\Seo\UI\WEB\Requests\StoreSeoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSeoRequest $request): JsonResponse
    {
        $seoId = $this->createSeoAction->run($request->mapped());

        return response()->json(['id' => $seoId])->setStatusCode(200);
    }


    /**
     * @param int                                                              $id
     * @param \App\Containers\Constructor\Seo\UI\WEB\Requests\UpdateSeoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, UpdateSeoRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);
        $this->updateSeoAction->run($data);

        return response()->json()->setStatusCode(200);
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->deleteSeoAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
