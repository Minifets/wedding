<?php

namespace App\Security;

use App\Service\JWTManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class AppAuthenticator extends AbstractGuardAuthenticator
{
    const COOKIE_NAME = 'X-GUEST-TOKEN';

    private $entityManager;
    private $jwtManager;

    public function __construct(EntityManagerInterface $entityManager, JWTManager $jwtManager)
    {
        $this->entityManager = $entityManager;
        $this->jwtManager    = $jwtManager;
    }

    public function supports(Request $request): bool
    {
        return $request->cookies->has(self::COOKIE_NAME);
    }

    public function getCredentials(Request $request): array
    {
        return $this->jwtManager->decode($request->cookies->get(self::COOKIE_NAME));
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        if (null === $credentials) {
            return null;
        }

        return $userProvider->loadUserByUsername($credentials['login'] ?? '');
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse();
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey): ?Response
    {
        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        return new JsonResponse();
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }
}
