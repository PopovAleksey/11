<?php

namespace App\Containers\Constructor\Seo\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Seo\Models
 * @method static Builder query()
 * @property integer                                                            $id
 * @property integer                                                            $page_id
 * @property integer                                                            $page_field_id
 * @property integer                                                            $language_id
 * @property string                                                             $case_type
 * @property bool                                                               $active
 * @property bool                                                               $static
 * @property Carbon                                                             $created_at
 * @property Carbon                                                             $updated_at
 * @property-read \App\Containers\Constructor\Page\Models\PageInterface         $page
 * @property-read \App\Containers\Constructor\Page\Models\PageFieldInterface    $pageField
 * @property-read \App\Containers\Constructor\Language\Models\LanguageInterface $language
 * @property-read \Illuminate\Database\Eloquent\Collection                      $links
 */
interface SeoInterface
{
    public const CAMEL_CASE  = 'camelCase';
    public const PASCAL_CASE = 'pascalCase';
    public const SNAKE_CASE  = 'snakeCase';
    public const KEBAB_CASE  = 'kebabCase';
}