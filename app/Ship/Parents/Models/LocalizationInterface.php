<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Localization\Models
 * @method static Builder query()
 * @property integer                $id
 * @property string                 $point
 * @property integer                $language_id
 * @property integer                $theme_id
 * @property string                 $value
 * @property Carbon                 $created_at
 * @property Carbon                 $updated_at
 * @property-read LanguageInterface $language
 * @property-read ThemeInterface    $theme
 */
interface LocalizationInterface
{
}