<?php

namespace App\Controller\Admin;

use App\Entity\Gallery\Folder;
use App\Entity\Gallery\Photo;
use App\Entity\Quiz\Question;
use App\Entity\Quiz\Team;
use App\Entity\User\Guest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Wedding');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Приглашения');
        yield MenuItem::linkToCrud('Гости', 'fas fa-user', Guest::class);
        yield MenuItem::section('Галлерея');
        yield MenuItem::linkToCrud('Папки', 'fas fa-folder', Folder::class);
        yield MenuItem::linkToCrud('Фото', 'fas fa-camera', Photo::class);
        yield MenuItem::section('Викторина');
        yield MenuItem::linkToCrud('Команды', 'fas fa-users', Team::class);
        yield MenuItem::linkToCrud('Вопросы', 'fas fa-question', Question::class);
    }
}
