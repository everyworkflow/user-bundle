<?php

namespace EveryWorkflow\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method string getUserIdentifier()
 */
class WebserviceUser implements UserInterface, EquatableInterface, PasswordAuthenticatedUserInterface
{
    private string $username;
    private string $email;
    private string $password;
    private string $salt;
    private array $roles;
    private string $entity;

    /**
     * User constructor.
     *
     * @param $username
     */
    public function __construct($username)
    {
        $this->setUsername($username);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }


    /**
     * @param $password
     *
     * @return void
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return array|string[]
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return void
     */
    public function eraseCredentials()
    {
    }

    public function setEntity(\EveryWorkflow\EavBundle\Entity\BaseEntityInterface $entity): void
    {
        $this->entity = $entity;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    public function __call(string $name, array $arguments)
    {
        return $this->getUsername();
    }
}
