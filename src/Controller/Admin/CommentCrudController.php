<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('author', 'Votre Nom'),
            TextField::new('email', 'Votre Email'),
            AssociationField::new('conference', 'Conférence')->autocomplete(),
            ImageField::new('photoFilename', 'Image')->setBasePath('uploads')
            ->setUploadDir('public/uploads')->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            TextareaField::new('text', 'Commentaire'),
        ];
    }
    
}
