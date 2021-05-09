<?php

namespace App\Controller;

use App\Repository\Gallery\FolderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route(path="/", name="app_homepage")
     */
    public function index(FolderRepository $gallery): Response
    {
        return $this->render('homepage/index.html.twig');
    }
}
