<?php

namespace App\Form;

use App\Entity\Contact;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' =>'Prénom',
                'attr' => ['placeholder' => 'Jean'],

            ])
            ->add('lastname',TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Delmar'],
            ])
            ->add('company')
            ->add('number')
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'jeandelmar@gmail.com'],
            ])
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
