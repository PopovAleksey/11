<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Page\Models
 * @method static Builder query()
 * @property integer                                       $id
 * @property integer|null                                  $parent_page_id
 * @property string                                        $name
 * @property string                                        $type
 * @property boolean                                       $active
 * @property Carbon                                        $created_at
 * @property Carbon                                        $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection $fields
 * @property-read PageInterface|null                       $child_page
 */
interface PageInterface
{
    public const SIMPLE_TYPE   = 'simple';
    public const BLOG_TYPE     = 'blog';
    public const CATEGORY_TYPE = 'category';
}