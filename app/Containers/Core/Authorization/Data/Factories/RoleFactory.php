<?php

namespace App\Containers\Core\Authorization\Data\Factories;

use App\Containers\Core\Authorization\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->slug,
        ];
    }
}
