<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'required' => false
            ])
            ->add('description', TextType::class, [
                'label' => 'Description :',
                'required' => false
            ])
            // Je créé un nouveau champ de formulaire
            // ce champ est pour la propriété 'article'
            // vu que ce champ contient une relation vers
            // une autre entité, le type choisi doit être
            // EntityType
            ->add('article', EntityType::class, [
                'class' => Article::class,
                'attr' => [
                    'required' => false
                ],
                'choice_label' => function(Article $article)
                {return $article->getName() . ' ' . $article->getName();},
                'placeholder' => "Choisissez un article",
                'required' => false,
            ])

            ->add('couleur', ChoiceType::class, [
                    'label' => 'Couleur :',
                    'choices' => [
                    'Blanc' => 'blanc',
                    'Bleu marine' => 'bleu marine',
                    'Argent' => 'argent',
                    'Or' => 'or'
                ]])

            ->add('Valider', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
