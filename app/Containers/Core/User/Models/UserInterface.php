<?php

namespace App\Containers\Core\User\Models;

use Illuminate\Support\Carbon;

/**
 * @property integer      $id
 * @property string       $name
 * @property string       $email
 * @property Carbon       $email_verified_at
 * @property string       $gender
 * @property Carbon       $birth
 * @property string       $device
 * @property string       $platform
 * @property boolean      $is_admin
 * @property Carbon       $created_at
 * @property Carbon       $updated_at
 * @property-read string  $remember_token
 * @property-read  string $password
 */
interface UserInterface
{

}