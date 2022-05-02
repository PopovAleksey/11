<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @package App\Containers\Dashboard\Configuration\Models
 * @method static Builder query()
 * @property string $config
 * @property string $value
 */
interface ConfigurationCommonInterface
{
    public const DEFAULT_INDEX    = 'default_index';
    public const DEFAULT_LANGUAGE = 'default_language';
}