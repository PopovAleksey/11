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
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(SeoDto $data): void
    {
        try {
            if ($data->isActive() !== null) {
                $update = ['active' => $data->isActive()];
            } elseif ($data->isStatic() !== null) {
                $update = ['static' => $data->isStatic()];
            } else {
                throw new UpdateResourceFailedException('Invalid update data!');
            }

            $this->repository->update($update, $data->getId());

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
