<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Localization\Models
 * @method static Builder query()
 * @property integer                                       $id
 * @property string                                        $point
 * @property integer                                       $theme_id
 * @property Carbon                                        $created_at
 * @property Carbon                                        $updated_at
 * @property-read ThemeInterface                           $theme
 * @property-read integer                                  $language_id
 * @property-read string                                   $value
 * @property-read \Illuminate\Database\Eloquent\Collection $values
 * @property-read string                                   $language_name
 * @property-read string                                   $language_short_name
 * @property-read string                                   $theme_name
 */
interface LocalizationInterface
{
}