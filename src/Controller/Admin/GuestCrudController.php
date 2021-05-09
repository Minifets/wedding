<?php

namespace App\Controller\Admin;

use App\Entity\User\Guest;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class GuestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guest::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('secret', 'Секретная фраза')
                ->onlyOnForms(),
            UrlField::new('secret', 'Пригласительная ссылка')
                ->onlyOnIndex()
                ->setTemplatePath('admin/crud/field/inviteUrl.html.twig'),
            TextField::new('title', 'Индивидуальное приветствие'),
            TextEditorField::new('message', 'Индивидуальный текст'),
            ArrayField::new('persons', 'Имена гостей'),
            ArrayField::new('confirmations', 'Подтверждения')
                ->onlyOnIndex()
        ];
    }

}
