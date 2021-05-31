<?php

namespace App\Controller\Admin;

use App\Entity\Quiz\Team;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Team::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Название команды'),
            AssociationField::new('players', 'Игроки')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('captain', 'Капитан')
        ];
    }
}
