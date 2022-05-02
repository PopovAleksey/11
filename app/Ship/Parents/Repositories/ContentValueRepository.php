<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ContentValue;

class ContentValueRepository extends Repository implements ContentValueRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'            => '=',
        'language_id'   => '=',
        'content_id'    => '=',
        'page_field_id' => '=',
        'value'         => 'like',
    ];

    public function model(): string
    {
        return ContentValue::class;
    }

    /**
     * @param array $data
     * @param array $condition
     * @return bool
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function updateByCondition(array $data, array $condition): bool
    {
        return $this->makeModel()::query()
            ->where($condition)
            ->update($data);
    }
}
