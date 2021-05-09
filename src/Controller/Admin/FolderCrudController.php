<?php

namespace App\Controller\Admin;

use App\Entity\Gallery\Folder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FolderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Folder::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Название'),
            AssociationField::new('thumbnail', 'Фото обложки')
        ];
    }

}
