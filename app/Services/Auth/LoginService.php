<?php

namespace App\Services\Auth;

use App\Models\User;

class LoginService
{
    /**
     * @var string|null $email
     */
    public $email = null;

    /**
     * @var string|null $password
     */
    public $password = null;

    /**
     * @param string|null $email
     * @return self
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
     * @return self
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

    public function process()
    {
    }
}
