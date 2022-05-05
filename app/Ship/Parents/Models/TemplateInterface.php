<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Template\Models
 * @method static Builder query()
 * @property integer                     $id
 * @property string                      $type
 * @property integer                     $theme_id
 * @property integer                     $page_id
 * @property integer                     $child_page_id
 * @property integer                     $language_id
 * @property string                      $template_filepath
 * @property string                      $child_template_filepath
 * @property Carbon                      $created_at
 * @property Carbon                      $updated_at
 * @property-read ThemeInterface         $theme
 * @property-read PageInterface|null     $page
 * @property-read PageInterface|null     $child_page
 * @property-read LanguageInterface|null $language
 */
interface TemplateInterface
{
    public const BASE_TYPE = 'base';
    public const JS_TYPE   = 'js';
    public const CSS_TYPE  = 'css';
    public const MENU_TYPE = 'menu';
    public const PAGE_TYPE = 'page';
}