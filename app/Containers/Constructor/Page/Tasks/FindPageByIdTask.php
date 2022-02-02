<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Containers\Constructor\Page\Models\PageFieldInterface;
use App\Ship\Exceptions\NotFoundException;
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
     * @return \App\Containers\Constructor\Page\Data\Dto\PageDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id, bool $withFields = false): PageDto
    {
        try {
            /**
             * @var \App\Containers\Constructor\Page\Models\PageInterface $page
             */
            $page = $this->repository->find($id);

            $pageDto = (new PageDto())
                ->setId($page->id)
                ->setName($page->name)
                ->setType($page->type)
                ->setActive($page->active)
                ->setCreateAt($page->created_at)
                ->setUpdateAt($page->updated_at);

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