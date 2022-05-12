<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Dashboard\Configuration\Models
 * @method static Builder query()
 * @property integer $id
 * @property string  $name
 * @property boolean $active
 * @property integer $template_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
interface ConfigurationMenuInterface
{
}