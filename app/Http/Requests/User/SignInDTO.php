<?php

namespace App\Http\Requests\User;

use App\Mappers\Mapper;

/**
 * Class SignInDTO
 * @package App\Mappers\Requests\User
 */
class SignInDTO extends Mapper
{
    private string $email;
    private string $password;

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
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = md5($password);

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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
