<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Conference Comment')
            ->setEntityLabelInPlural('Conference Comments')
            ->setSearchFields(['author','text','email','conference.city']) //imposta i campi per ricercare nella lista
            ->setDefaultSort(['createdAt'=>'DESC']);  //imposta l'ordine di visualizzazione della lista
    }

    public function configureFilters(Filters $filters): Filters
    {
        //Aggiunge pulsante per filtri nella lista principale(Index)
        return $filters
            ->add(EntityFilter::new('conference'))
            ->add('email');
    }

    public function configureFields(string $pageName): iterable
    {
       yield AssociationField::new('conference'); //imposta il campo per cui è prevista l'associazione con un altra entità
       yield TextField::new('author');
       yield EmailField::new('email');
       yield TextareaField::new('text')
            ->hideOnIndex(); //nasconde il campo nella lista principale (Index)
       yield ImageField::new('photoFileName')
            ->setBasePath('/uploads/photos')
            ->setLabel('Photo')
            ->onlyOnIndex(); //mostra il campo solamente nella lista principale(Index)
       
        $createdAt = DateTimeField::new('createdAt')->setFormTypeOptions([
                       'html5' => true,
                        'years' => range(date('Y'), date('Y') + 5),
                        'widget' => 'single_text',
                    ]);

       if(Crud::PAGE_EDIT === $pageName)
       {
           yield $createdAt->setFormTypeOption('disabled', true);
       }
       else
       {
           yield $createdAt;
       }
    
    }
    
}
