<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Models\TemplateWidgetInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;

class ContentRepository extends Repository implements ContentRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'      => '=',
        'page_id' => '=',
        'active'  => '=',
    ];

    public function model(): string
    {
        return ContentInterface::class;
    }

    /**
     * @param int    $pageId
     * @param int    $limit
     * @param string $byCriteria
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getFewContentIds(int $pageId, int $limit, string $byCriteria): Collection
    {
        $query = $this->makeModel()::query()
            ->select('c.id')
            ->from(app(ContentInterface::class)->getTable(), 'c')
            ->leftJoin(app(PageInterface::class)->getTable() . ' AS p', 'p.id', '=', 'c.page_id')
            ->where([
                'c.page_id'        => $pageId,
                'p.type'           => PageInterface::SIMPLE_TYPE,
                'p.parent_page_id' => null,
            ])
            ->limit($limit);

        return match ($byCriteria) {
            TemplateWidgetInterface::SHOW_RANDOM => $query->orderBy(DB::raw('RAND()'))->get(),
            TemplateWidgetInterface::SHOW_FIRST => $query->orderBy('c.created_at')->get(),
            TemplateWidgetInterface::SHOW_LAST => $query->orderByDesc('c.created_at')->get(),
        };
    }
}
