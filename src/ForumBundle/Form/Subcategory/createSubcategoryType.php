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

    class createSubcategoryType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('title', TextType::class, [
                    'label' => 'Name :',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your subcategory\'s name'
                    ]
                ])
                ->add('description', TextareaType::class, [
                    'label' => 'Description',
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => '2',
                        'placeholder' => 'Enter your description'
                    ]
                ])
                ->add('isPosted', ChoiceType::class, [
                    'label' => 'Do you want to make it public',
                    'choices' => [
                        'Yes' => true,
                        'No' => false
                    ]
                ])
                ->add('category', EntityType::class, [
                    'class' => 'ForumBundle:Category',
                    'label' => 'Category :'
                ])
                ->add('submit', SubmitType::class,[
                    'label' => 'Create',
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