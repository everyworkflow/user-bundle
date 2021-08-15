<?php

namespace EveryWorkflow\UserBundle\Security\User;

use EveryWorkflow\UserBundle\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class WebserviceUserProvider implements UserProviderInterface
{
    private UserRepositoryInterface $userRepository;

    /**
     * WebserviceUserProvider constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername(string $username)
    {
        $userEntity = $this->userRepository->findByIndex($username);

        $user = new WebserviceUser($userEntity->getData('email'));
        $user->setPassword($userEntity->getData('password'));
        $user->setEmail($userEntity->getData('email'));
        $user->setEntity($userEntity);

        return $user;

        throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
    }

    public function refreshUser(UserInterface $user)
    {
        echo 'refressh';
        exit;
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return 'EveryWorkflow\UserBundle\Security\User\WebserviceUser' === $class;
    }
}
