<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Constructor\Seo\Data\Repositories\SeoLinkRepositoryInterface;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateContentSeoLinkTask extends Task implements CreateContentSeoLinkTaskInterface
{
    public function __construct(
        private SeoRepositoryInterface     $seoRepository,
        private SeoLinkRepositoryInterface $seoLinkRepository
    )
    {
    }

    /**
     * @param \App\Containers\Dashboard\Content\Data\Dto\ContentDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(ContentDto $data): bool
    {
        try {
            $seoData = $this->seoRepository->findByField('page_id', $data->getPageId());
            dd($seoData, $data);
            return $this->seoLinkRepository->create($data->toArray());

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

