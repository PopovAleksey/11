<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @package App\Containers\Dashboard\Configuration\Models
 * @method static Builder query()
 * @property string  $config
 * @property integer $language_id
 * @property string  $value
 */
interface ConfigurationCommonInterface
{
    public const DEFAULT_INDEX    = 'default_index';
    public const DEFAULT_LANGUAGE = 'default_language';
    public const DEFAULT_THEME    = 'default_theme';
    public const TITLE            = 'title';
    public const DESCRIPTION      = 'description';
    public const TITLE_SEPARATOR  = 'title_separator';
    public const META_CHARSET     = 'meta_charset';
    public const META_DESCRIPTION = 'meta_description';
    public const META_KEYWORDS    = 'meta_keywords';
    public const META_AUTHOR      = 'meta_author';
}