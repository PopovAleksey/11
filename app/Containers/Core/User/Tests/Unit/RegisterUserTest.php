<?php

namespace App\Containers\Core\User\Tests\Unit;

use App\Containers\Core\User\Actions\RegisterUserAction;
use App\Containers\Core\User\Models\User;
use App\Containers\Core\User\Tests\TestCase;
use App\Containers\Core\User\UI\API\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\App;

/**
 * Class CreateUserTest.
 *
 * @group user
 * @group unit
 */
class RegisterUserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];

        $request = new RegisterUserRequest($data);
        $user = App::make(RegisterUserAction::class)->run($request);

        self::assertInstanceOf(User::class, $user);
        self::assertEquals($user->name, $data['name']);
    }
}
