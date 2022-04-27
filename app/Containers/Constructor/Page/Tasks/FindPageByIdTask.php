<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Models\PageFieldInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindPageByIdTask extends Task implements FindPageByIdTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param int  $id
     * @param bool $withFields
     * @return \App\Ship\Parents\Dto\PageDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id, bool $withFields = false): PageDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\PageInterface $page
             */
            $page = $this->repository->find($id);

            $pageDto = (new PageDto())
                ->setId($page->id)
                ->setName($page->name)
                ->setType($page->type)
                ->setActive($page->active)
                ->setCreateAt($page->created_at)
                ->setUpdateAt($page->updated_at);

            if ($pageDto->getType() === PageInterface::BLOG_TYPE) {
                $childPage = $page->child_page;

                $childPageDto = (new PageDto())
                    ->setId($childPage->id)
                    ->setName($childPage->name)
                    ->setType($childPage->type)
                    ->setActive($childPage->active)
                    ->setCreateAt($childPage->created_at)
                    ->setUpdateAt($childPage->updated_at);

                $pageDto->setChildPage($childPageDto);
            }

            if ($withFields === false) {
                return $pageDto;
            }

            $fields = $page->fields->map(static function (PageFieldInterface $field) {
                return (new PageFieldDto())
                    ->setId($field->id)
                    ->setPageId($field->page_id)
                    ->setType($field->type)
                    ->setName($field->name)
                    ->setPlaceholder($field->placeholder)
                    ->setMask($field->mask)
                    ->setValues($field->values)
                    ->setActive($field->active)
                    ->setCreateAt($field->created_at)
                    ->setUpdateAt($field->updated_at);
            });

            return $pageDto->setFields($fields->toArray());

        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
