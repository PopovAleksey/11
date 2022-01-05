<?php

namespace App\Containers\Development\Logger\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @package App\Containers\Development\Logger\Models
 * @method static Builder query()
 * @property integer $id
 * @property string  $hash
 * @property string  $request
 * @property string  $type
 * @property string  $query
 * @property string  $bindings
 * @property integer $time
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
interface LoggerInterface
{

}