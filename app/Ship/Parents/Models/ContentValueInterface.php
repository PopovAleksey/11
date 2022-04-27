<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Dashboard\Content\Models
 * @method static Builder query()
 * @property integer                                          $id
 * @property integer                                          $language_id
 * @property integer                                          $content_id
 * @property integer                                          $page_field_id
 * @property string                                           $value
 * @property Carbon                                           $created_at
 * @property Carbon                                           $updated_at
 * @property-read \App\Ship\Parents\Models\LanguageInterface  $language
 * @property-read \App\Ship\Parents\Models\ContentInterface   $content
 * @property-read \App\Ship\Parents\Models\PageFieldInterface $page_field
 */
interface ContentValueInterface
{
}