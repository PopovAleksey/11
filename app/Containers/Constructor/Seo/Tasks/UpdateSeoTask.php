<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\SeoDto;
use App\Ship\Parents\Repositories\SeoRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateSeoTask extends Task implements UpdateSeoTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\SeoDto $data
     * @return \App\Ship\Parents\Dto\SeoDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(SeoDto $data): SeoDto
    {
        try {
            if ($data->isActive() !== null) {
                $update = ['active' => $data->isActive()];
            } elseif ($data->isStatic() !== null) {
                $update = ['static' => $data->isStatic()];
            } else {
                throw new UpdateResourceFailedException('Invalid update data!');
            }

            /**
             * @var \App\Containers\Constructor\Seo\Models\SeoInterface $seo
             */
            $seo = $this->repository->update($update, $data->getId());

            return (new SeoDto())
                ->setId($seo->id)
                ->setPageId($seo->page_id)
                ->setPageFieldId($seo->page_field_id)
                ->setLanguageId($seo->language_id)
                ->setCaseType($seo->case_type)
                ->setStatic($seo->static)
                ->setActive($seo->active)
                ->setCreateAt($seo->created_at)
                ->setUpdateAt($seo->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
