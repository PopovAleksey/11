<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Parents\Dto\MenuDto;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationTask extends Task implements GetAllMenuConfigurationTaskInterface
{
    public function __construct(
        private PageRepositoryInterface              $pageRepository,
        private ConfigurationMenuRepositoryInterface $configurationMenuRepository,
        private ContentRepositoryInterface           $contentRepository,
        private ContentValueRepositoryInterface      $contentValueRepository
    )
    {
    }

    public function run(): Collection
    {
        $menuList   = $this->configurationMenuRepository
            ->all()
            ->collect()
            ->keyBy('content_id');
        $pageIds    = $this->pageRepository
            ->all()
            ->collect()
            ->reject(fn(PageInterface $page) => $page->parent_page_id !== null || $page->active === false)
            ->keyBy('id')
            ->keys()
            ->toArray();
        $contentIds = $this->contentRepository
            ->findWhereIn('page_id', $pageIds)
            ->keyBy('id')
            ->keys()
            ->toArray();


        return $this->contentValueRepository
            ->orderBy('id')
            ->findWhereIn('content_id', $contentIds)
            ->filter(fn(ContentValueInterface $value) => $value->language_id === 1)
            ->groupBy('content_id')
            ->map(static function (Collection $content) use ($menuList) {
                /**
                 * @var ContentValueInterface $contentValue
                 */
                $contentValue = $content->first();
                /**
                 * @var ConfigurationMenuInterface|null $menuItem
                 */
                $menuItem = $menuList->get($contentValue->content_id);

                return (new MenuDto())
                    ->setId($menuItem?->id)
                    ->setName($contentValue->value)
                    ->setInMenu(!is_null($menuItem))
                    ->setContentId($contentValue->content_id)
                    ->setCreateAt($menuItem?->created_at)
                    ->setUpdateAt($menuItem?->updated_at);
            });
    }
}
