<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSeoTask extends Task implements CreateSeoTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Seo\Data\Dto\SeoDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(SeoDto $data): int
    {
        try {
            /**
             * @var \App\Containers\Constructor\Seo\Models\SeoInterface $seo
             */
            $seo = $this->repository->create([
                'page_id'       => $data->getPageId(),
                'page_field_id' => $data->getPageFieldId(),
                'language_id'   => $data->getLanguageId(),
                'case_type'     => $data->getCaseType(),
            ]);

            return $seo->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

