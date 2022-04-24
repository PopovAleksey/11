<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Containers\Dashboard\Configuration\Data\Dto\MenuDto;
use App\Containers\Dashboard\Configuration\Data\Repositories\ConfigurationMenuRepositoryInterface;
use App\Containers\Dashboard\Configuration\Models\ConfigurationMenuInterface;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Containers\Dashboard\Content\Data\Repositories\ContentValueRepositoryInterface;
use App\Containers\Dashboard\Content\Models\ContentValueInterface;
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
            ->orderBy('id', 'asc')
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
