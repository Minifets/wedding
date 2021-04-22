<?php

namespace App\Controller;

use App\Entity\User\Guest;
use App\Security\AppAuthenticator;
use App\Service\JWTManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InviteController extends AbstractController
{
    /**
     * @Route("/invite/{secret}", name="app_invite")
     *
     * @param JWTManager $jwtManager
     * @param Guest|null $guest
     * @return Response
     */
    public function index(JWTManager $jwtManager, Guest $guest = null): Response
    {
        if ($guest) {
            $jwtToken   = $jwtManager->encode(['login' => $guest->getLogin()]);
            $authCookie = Cookie::create(AppAuthenticator::COOKIE_NAME, $jwtToken, strtotime('2030-01-01'));

            $response = new Response();
            $response->headers->setCookie($authCookie);
        }

        return $this->render('invite/index.html.twig', [
            'guest' => $guest
        ], $response ?? null);
    }
}
