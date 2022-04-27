<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\SeoDto;
use App\Ship\Parents\Repositories\SeoRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSeoTask extends Task implements CreateSeoTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\SeoDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(SeoDto $data): int
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\SeoInterface $seo
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

