<?php

namespace App\Controller\Admin;

use App\Entity\Gallery\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('folder'),
            ImageField::new('fileName')
                ->setUploadDir('public/uploads/photo')
                ->setBasePath('uploads/photo')
        ];
    }

}
