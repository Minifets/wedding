<?php

namespace App\Controller\Admin;

use App\Entity\Gallery\Folder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FolderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Folder::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
