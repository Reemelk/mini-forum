<?php

    namespace ForumBundle\Form\Topic;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class TopicType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('title', TextType::class, [
                'label' => 'Title :',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter a name'
                ]
            ]);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(['data_class' => 'ForumBundle\Entity\Topic']);
        }
    }