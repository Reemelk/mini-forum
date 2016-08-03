<?php

    namespace ForumBundle\Form\Category;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class createCategoryType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
           $builder
               ->setMethod('POST')
               ->add('title', TextType::class, [
                   'label' => 'Create Category',
                   'attr' => [
                       'class' => 'form-control',
                       'placeholder' => 'Enter your category\'s name'
                   ]
               ])
               ->add('isPosted', ChoiceType::class, [
                   'label' => 'Do you want to make it public ?',
                   'choices' => [
                       'Yes' => true,
                       'No' => false
                   ]
               ])
               ->add('submit', SubmitType::class, [
                   'label' => 'Create',
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