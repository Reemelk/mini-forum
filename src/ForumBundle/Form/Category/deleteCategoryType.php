<?php

    namespace ForumBundle\Form\Category;

    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class deleteCategoryType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->setMethod('DELETE')
                ->add('title', EntityType::class, [
                    'label' => 'Category to delete :',
                    'class' => 'ForumBundle:Category',
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
            $resolver->setDefaults(['data_class' => 'ForumBundle\Entity\Category']);
        }
    }