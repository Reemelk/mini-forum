<?php

    namespace ForumBundle\Form\Thread;
    
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    class ReplyType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->setMethod('POST')
                ->add('reply', TextareaType::class, [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => '3',
                        'placeholder' => 'Enter your message'
                    ]
                ])
                ->add('submit', SubmitType::class, [
                    'label' => 'Post',
                    'attr' => [
                        'class' => 'btn btn-secondary btn-lg'
                    ]
                ])
            ;
        }
    
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(['data_class' => 'ForumBundle\Entity\Thread']);
        }
    }