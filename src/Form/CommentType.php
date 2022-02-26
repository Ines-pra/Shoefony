<?php

namespace App\Form;

use App\Entity\Store\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CommentType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('message', TextType::class, [
                'label' => 'Message'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void 
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}