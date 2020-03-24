<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\News;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('content')
            ->add('images')
            ->add('tags',EntityType::class,[
                'class'=>Tag::class,
                'choice_label'=>'name',
                'multiple'=>true
            ])
            ->add('category',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'name'
            ])
            ->add('isPublished')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
