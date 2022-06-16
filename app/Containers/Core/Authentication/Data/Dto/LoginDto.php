<?php

namespace App\Containers\Core\Authentication\Data\Dto;

use PopovAleksey\Mapper\Mapper;

class LoginDto extends Mapper
{
    private ?string $email      = null;
    private ?string $name       = null;
    private ?string $password   = null;
    private bool    $rememberMe = true;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return LoginDto
     */
    public function setName(?string $name): LoginDto
    {
        $this->name = $name;

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
     * @param string|null $password
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRememberMe(): bool
    {
        return $this->rememberMe;
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
}