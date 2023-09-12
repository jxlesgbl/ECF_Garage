<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('yearMin', NumberType::class, [
            'label' => 'Année minimale',
            'required' => false, // Allow this field to be optional
        ])
        ->add('yearMax', NumberType::class, [
            'label' => 'Année maximale',
            'required' => false, // Allow this field to be optional
        ])
        ->add('mileageMin', NumberType::class, [
            'label' => 'Kilométrage minimum',
            'required' => false, // Allow this field to be optional
        ])
        ->add('mileageMax', NumberType::class, [
            'label' => 'Kilométrage maximum',
            'required' => false, // Allow this field to be optional
        ])
        ->add('priceMin', NumberType::class, [
            'label' => 'Prix minimum',
            'required' => false, // Allow this field to be optional
        ])
        ->add('priceMax', NumberType::class, [
            'label' => 'Prix maximum',
            'required' => false, // Allow this field to be optional
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
