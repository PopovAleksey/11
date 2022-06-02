<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Ship\Parents\Models
 * @method static Builder query()
 * @property integer                                         $id
 * @property integer                                         $template_id
 * @property integer                                         $count_elements
 * @property string                                          $show_by
 * @property Carbon                                          $created_at
 * @property Carbon                                          $updated_at
 * @property-read \App\Ship\Parents\Models\TemplateInterface $template
 * @property-read  integer                                   $content_id
 * @property-read  integer                                   $page_id
 * @property-read  integer                                   $page_field_id
 * @property-read  string                                    $link
 * @property-read  boolean                                   $seo_active
 * @property-read  integer                                   $language_id
 * @property-read  string                                    $value
 * @property-read  string                                    $short_name
 */
interface TemplateWidgetInterface
{
    public const SHOW_LAST   = 'last';
    public const SHOW_FIRST  = 'first';
    public const SHOW_RANDOM = 'random';
}