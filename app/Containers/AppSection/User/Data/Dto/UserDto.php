<?php

namespace App\Containers\AppSection\User\Data\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class UserDto extends Mapper
{
    private ?int    $id                = NULL;
    private ?string $name              = NULL;
    private ?string $email             = NULL;
    private ?Carbon $email_verified_at = NULL;
    private ?string $gender            = NULL;
    private ?Carbon $birth             = NULL;
    private ?string $device            = NULL;
    private ?string $platform          = NULL;
    private ?bool   $is_admin          = NULL;
    private ?Carbon $created_at        = NULL;
    private ?Carbon $updated_at        = NULL;
    private ?string $remember_token    = NULL;
    private ?string $password          = NULL;

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

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
     * @param \Illuminate\Support\Carbon|null $email_verified_at
     * @return $this
     */
    public function setEmailVerifiedAt(?Carbon $email_verified_at): self
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->email_verified_at;
    }

    /**
     * @param string|null $gender
     * @return $this
     */
    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $birth
     * @return $this
     */
    public function setBirth(?Carbon $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getBirth(): ?Carbon
    {
        return $this->birth;
    }

    /**
     * @param string|null $device
     * @return $this
     */
    public function setDevice(?string $device): self
    {
        $this->device = $device;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDevice(): ?string
    {
        return $this->device;
    }

    /**
     * @param string|null $platform
     * @return $this
     */
    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param bool|null $is_admin
     * @return $this
     */
    public function setIsAdmin(?bool $is_admin): self
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsAdmin(): ?bool
    {
        return $this->is_admin;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $created_at
     * @return $this
     */
    public function setCreatedAt(?Carbon $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $updated_at
     * @return $this
     */
    public function setUpdatedAt(?Carbon $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param string|null $remember_token
     * @return \App\Containers\AppSection\User\Data\Dto\UserDto
     */
    public function setRememberToken(?string $remember_token): self
    {
        $this->remember_token = $remember_token;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->remember_token;
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
}