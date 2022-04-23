<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Page\Actions\FindPageByIdActionInterface;
use App\Containers\Dashboard\Content\Actions\CreateContentActionInterface;
use App\Containers\Dashboard\Content\Actions\DeleteContentActionInterface;
use App\Containers\Dashboard\Content\Actions\FindContentByIdActionInterface;
use App\Containers\Dashboard\Content\Actions\GetAllContentActionInterface;
use App\Containers\Dashboard\Content\Actions\GetMenuListActionInterface;
use App\Containers\Dashboard\Content\Actions\UpdateContentActionInterface;
use App\Containers\Dashboard\Content\UI\WEB\Requests\StoreContentRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;

class Controller extends WebController
{
    /**
     * @param \App\Containers\Dashboard\Content\Actions\GetMenuListActionInterface        $getMenuListAction
     * @param \App\Containers\Constructor\Page\Actions\FindPageByIdActionInterface        $findPageByIdAction
     * @param \App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface $getAllLanguagesAction
     * @param \App\Containers\Dashboard\Content\Actions\FindContentByIdActionInterface    $findContentByIdAction
     * @param \App\Containers\Dashboard\Content\Actions\CreateContentActionInterface      $createContentAction
     * @param \App\Containers\Dashboard\Content\Actions\GetAllContentActionInterface      $getAllContentsAction
     * @param \App\Containers\Dashboard\Content\Actions\UpdateContentActionInterface      $updateContentAction
     * @param \App\Containers\Dashboard\Content\Actions\DeleteContentActionInterface      $deleteContentAction
     */
    public function __construct(
        private GetMenuListActionInterface     $getMenuListAction,
        private FindPageByIdActionInterface    $findPageByIdAction,
        private GetAllLanguagesActionInterface $getAllLanguagesAction,
        private FindContentByIdActionInterface $findContentByIdAction,
        private CreateContentActionInterface   $createContentAction,
        private GetAllContentActionInterface   $getAllContentsAction,
        private UpdateContentActionInterface   $updateContentAction,
        private DeleteContentActionInterface   $deleteContentAction
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|View|Application
    {
        return view('dashboard.base', $this->menuBuilder());
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function menuBuilder(): Collection
    {
        return collect(['menu' => $this->getMenuListAction->run()]);
    }

    /**
     * @param int $pageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function showPage(int $pageId): Factory|View|Application
    {
        $contents = $this->getAllContentsAction->run($pageId);
        $field    = collect($contents->first()?->getPage()->getFields())->first();

        return view(
            'dashboard@content::list',
            $this->menuBuilder()->merge([
                'pageId'   => $pageId,
                'field'    => $field,
                'contents' => $contents,
            ]));
    }

    /**
     * @param int $pageId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(int $pageId): View|Factory|Redirector|RedirectResponse|Application
    {
        $page      = $this->findPageByIdAction->run($pageId, withFields: true);
        $languages = $this->getAllLanguagesAction->run(getOnlyActive: true);

        if ($page->isActive() === false) {
            return redirect(route('dashboard_content_index'));
        }

        return view(
            'dashboard@content::content-form',
            $this->menuBuilder()->merge([
                'pageId'    => $pageId,
                'contentId' => null,
                'page'      => $page,
                'values'    => [],
                'languages' => $languages,
            ]));
    }

    /**
     * @param int $contentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(int $contentId): Factory|View|Application
    {
        $content   = $this->findContentByIdAction->run($contentId);
        $languages = $this->getAllLanguagesAction->run(getOnlyActive: true);

        return view(
            'dashboard@content::content-form',
            $this->menuBuilder()->merge([
                'pageId'    => $content->getPageId(),
                'contentId' => $content->getId(),
                'page'      => $content->getPage(),
                'values'    => $content->getValues(),
                'languages' => $languages,
            ]));
    }

    /**
     * @param \App\Containers\Dashboard\Content\UI\WEB\Requests\StoreContentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreContentRequest $request): JsonResponse
    {
        $contentId = $this->createContentAction->run($request->mapped());

        return response()->json(['id' => $contentId])->setStatusCode(200);
    }

    /**
     * @param int                                                                   $id
     * @param \App\Containers\Dashboard\Content\UI\WEB\Requests\StoreContentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, StoreContentRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);
        $this->updateContentAction->run($data);

        return response()->json(['id' => $id])->setStatusCode(200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->deleteContentAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}
