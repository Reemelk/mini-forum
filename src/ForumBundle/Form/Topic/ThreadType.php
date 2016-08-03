<?php

    namespace ForumBundle\Form\Topic;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use ForumBundle\Form\Topic\TopicType;

    class ThreadType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->setMethod('POST')
                ->add('topic', TopicType::class, [
                    'label' => 'Create Topic'
                ])
                ->add('text', TextareaType::class, [
                    'label' => 'Message :',
                    'attr' => [
                        'class' => 'form-control',
                        'row' => '2',
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