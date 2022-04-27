<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Seo\Models
 * @method static Builder query()
 * @property integer                                    $id
 * @property integer                                    $seo_id
 * @property integer                                    $content_id
 * @property string                                     $link
 * @property Carbon                                     $created_at
 * @property Carbon                                     $updated_at
 * @property-read \App\Ship\Parents\Models\SeoInterface $seo
 */
interface SeoLinkInterface
{
}