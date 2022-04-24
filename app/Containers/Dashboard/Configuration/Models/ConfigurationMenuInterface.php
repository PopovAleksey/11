<?php

namespace App\Containers\Dashboard\Configuration\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Dashboard\Configuration\Models
 * @method static Builder query()
 * @property integer $id
 * @property integer $order
 * @property integer $content_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
interface ConfigurationMenuInterface
{
}