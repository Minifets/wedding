<?php

namespace App\Controller\Admin;

use App\Entity\Quiz\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('roundNumber', 'Номер раунда'),
            NumberField::new('position', 'Номер вопроса'),
            TextEditorField::new('question', 'Вопрос'),
            ArrayField::new('answers', 'Варианты ответа'),
            TextField::new('correctAnswer', 'Правильный ответ'),
            TextField::new('description', 'Развернутый ответ')
        ];
    }

}
