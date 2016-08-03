<?php

    namespace ForumBundle\Form\User;

    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class banUserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->setMethod('PUT')
                ->add('username', EntityType::class, [
                'label' => 'Username',
                'class' => 'ForumBundle\Entity\User'
                ])
                ->add('locked', ChoiceType::class, [
                    'choices' => [
                        'No' => false,
                        'Yes' => true
                    ]
                ])
                ->add('locked_for', TextType::class, [
                    'label' => 'how many times ban (in min)'
                ])
                ->add('locked_message', TextType::class, [
                    'label' => 'Ban message',
                    'attr' => [
                        'placeholder' => 'What reason'
                    ]
                ])
                ->add('submit', SubmitType::class, [
                    'label' => 'Update'
                ])
            ;
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(['data_class' => 'ForumBundle\Entity\User']);
        }
    }