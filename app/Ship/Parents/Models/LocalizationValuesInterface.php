<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Localization\Models
 * @method static Builder query()
 * @property integer                    $id
 * @property integer                    $localization_id
 * @property integer                    $language_id
 * @property string                     $value
 * @property Carbon                     $created_at
 * @property Carbon                     $updated_at
 * @property-read LocalizationInterface $localization
 * @property-read LanguageInterface     $language
 */
interface LocalizationValuesInterface
{
}