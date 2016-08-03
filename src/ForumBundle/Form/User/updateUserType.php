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

    class updateUserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->setMethod('PUT')
                ->add('username', EntityType::class, [
                    'label' => 'Username',
                    'class' => 'ForumBundle:User'
                ])
                ->add('enabled', ChoiceType::class, [
                    'label' => 'Do you want to desable',
                    'choices' => [
                        'No' => false,
                        'Yes' => true
                    ]
                ])
                ->add('new_username', TextType::class, [
                    'label' => 'New Username',
                    'required' => false
                ])
                ->add('email', EmailType::class, [
                    'label' => 'New e-Mail',
                    'required' => false
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