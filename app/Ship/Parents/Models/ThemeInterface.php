<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Constructor\Template\Models
 * @method static Builder query()
 * @property integer                                       $id
 * @property string                                        $name
 * @property bool                                          $active
 * @property Carbon                                        $created_at
 * @property Carbon                                        $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection $templates
 */
interface ThemeInterface
{
}