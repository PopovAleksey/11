<?php

namespace App\Mappers\Requests\User;

use App\Mappers\Mapper;

/**
 * Class SignInDTO
 * @package App\Mappers\Requests\User
 */
class SignInDTO extends Mapper
{
    private string $email;
    private int    $password;

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param int $password
     * @return $this
     */
    public function setPassword(int $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getPassword(): int
    {
        return $this->password;
    }
}
