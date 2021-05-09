<?php

namespace App\Controller;

use App\Entity\Gallery\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
    /**
     * @Route("/gallery/{slug}", name="app_gallery")
     */
    public function index(Folder $folder): Response
    {
        return $this->render(
            'gallery/index.html.twig',
            [
                'folder' => $folder,
                'photos' => $folder->getPhotos()
            ]
        );
    }
}
