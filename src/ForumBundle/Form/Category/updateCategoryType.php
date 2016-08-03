<?php

    namespace ForumBundle\Form\Category;

    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class updateCategoryType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->setMethod('PUT')
                ->add('title', EntityType::class, [
                    'label' => 'Category to modify:',
                    'class' => 'ForumBundle:Category'
                ])
                ->add('isPosted', ChoiceType::class, [
                    'label' => 'Do you want to make this category public',
                    'choices' => [
                        'Yes' => true,
                        'No' => false
                    ]
                ])
                ->add('new_name', TextType::class, [
                    'label' => 'New Name',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your new category\'s name'
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
            $resolver->setDefaults(['data_class' => 'ForumBundle\Entity\Category']);
        }
    }