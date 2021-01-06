<?php

namespace App\Mappers\Requests\User;

use App\Mappers\Mapper;

class SignInMapper extends Mapper
{
    protected ?string $email = null;
    protected ?int $password = null;
    /**
     * @var array<\App\Mappers\Requests\User\TestMapper>|null
     */
    #protected ?array $exampleForArrayWithClass = null;

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getPassword(): ?int
    {
        return $this->password;
    }
}
