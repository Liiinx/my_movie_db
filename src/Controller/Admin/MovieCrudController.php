<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('originalName'),
            DateField::new('releaseDate'),
            TextEditorField::new('synopsis'),
            ImageField::new('image')->setUploadDir("/public/assets/upload/images")
                                                ->setBasePath('assets/upload/images'),
            BooleanField::new('seen'),
            BooleanField::new('watchList'),
            AssociationField::new('studio'),
            AssociationField::new('actors'),
            AssociationField::new('genres')
        ];
    }

}
