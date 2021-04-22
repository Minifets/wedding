<?php

namespace App\Service;

use Firebase\JWT\JWT;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JWTManager
{
    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $publicKey;

    public function __construct(ContainerInterface $container)
    {
        $this->privateKey = file_get_contents($container->getParameter('jwt_secret_key'));
        $this->publicKey  = file_get_contents($container->getParameter('jwt_public_key'));
    }

    /**
     * @param array $payload
     * @return string
     */
    public function encode(array $payload): string
    {
        return JWT::encode($payload, $this->privateKey, 'RS256');
    }

    /**
     * @param string $token
     * @return array
     */
    public function decode(string $token): array
    {
        return (array) JWT::decode($token, $this->publicKey, ['RS256']);
    }
}