<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Page\Models
 * @method static Builder query()
 * @property integer                                                    $id
 * @property integer                                                    $page_id
 * @property string                                                     $name
 * @property string                                                     $type
 * @property string                                                     $placeholder
 * @property string                                                     $mask
 * @property string                                                     $values
 * @property bool                                                       $active
 * @property Carbon                                                     $created_at
 * @property Carbon                                                     $updated_at
 * @property-read PageInterface $page
 */
interface PageFieldInterface
{
    public const INPUT_TYPE           = 'input';
    public const TEXTAREA_TYPE        = 'textarea';
    public const SELECT_TYPE          = 'select';
    public const SELECT_MULTIPLE_TYPE = 'selectMultiple';
    public const RADIO_TYPE           = 'radio';
    public const CHECKBOX_TYPE        = 'checkbox';
    public const FILE_TYPE            = 'file';
}