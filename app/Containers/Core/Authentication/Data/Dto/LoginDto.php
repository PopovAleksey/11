<?php

namespace App\Containers\Core\Authentication\Data\Dto;

use PopovAleksey\Mapper\Mapper;

class LoginDto extends Mapper
{
    private ?string $email = NULL;

    private ?string $password = NULL;

    private bool $rememberMe = true;

    /**
     * @param string|null $email
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $password
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param bool $rememberMe
     * @return $this
     */
    public function setRememberMe(bool $rememberMe): self
    {
        $this->rememberMe = $rememberMe;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRememberMe(): bool
    {
        return $this->rememberMe;
    }
}