<?php

namespace ForumBundle\Form\Subcategory;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class deleteSubcategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('DELETE')
            ->add('title', EntityType::class, [
                'label' => 'Subcategory to delete :',
                'class' => 'ForumBundle:Subcategory'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Delete',
                'attr' => [
                    'class' => 'btn btn-secondary btn-lg'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'ForumBundle\Entity\Subcategory']);
    }
}