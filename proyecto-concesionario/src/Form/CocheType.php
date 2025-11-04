<?php

namespace App\Form;

use App\Entity\Coche;
use App\Entity\Marca;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modelo', TextType::class)
            ->add('anio', IntegerType::class)
            ->add('marca', EntityType::class, [
                'class' => Marca::class,
                'choice_label' => 'nombre',
                'label' => 'Marca'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coche::class
        ]);
    }
}
