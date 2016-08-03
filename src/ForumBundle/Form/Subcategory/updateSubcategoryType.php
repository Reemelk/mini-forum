<?php

namespace ForumBundle\Form\Subcategory;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class updateSubcategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('PUT')
            ->add('category', EntityType::class, [
                'label' => 'Category :',
                'class' => 'ForumBundle:Category'
            ])
            ->add('subcategory', EntityType::class, [
                'label' => 'Subcategory :',
                'class' => 'ForumBundle:Subcategory'
            ])
            ->add('isPosted', ChoiceType::class, [
                'label' => 'Do you want to make this category public',
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ]
            ])
            ->add('new_title', TextType::class, [
                'label' => 'New Title :',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter a new category name'
                ],
                'required' => false
            ])
            ->add('new_description', TextareaType::class, [
                'label' => 'New Description :',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '2',
                    'placeholder' => 'Enter your description'
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Update',
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