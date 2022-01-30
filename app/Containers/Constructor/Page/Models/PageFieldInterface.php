<?php

namespace App\Containers\Constructor\Page\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Page\Models
 * @method static Builder query()
 * @property integer                                                    $id
 * @property integer                                                    $page_id
 * @property string                                                     $name
 * @property string                                                     $type
 * @property string                                                     $placeholder
 * @property string                                                     $mask
 * @property string                                                     $values
 * @property bool                                                       $active
 * @property Carbon                                                     $created_at
 * @property Carbon                                                     $updated_at
 * @property-read \App\Containers\Constructor\Page\Models\PageInterface $page
 */
interface PageFieldInterface
{
}