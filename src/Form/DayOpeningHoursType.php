<?php

namespace App\Form;

use App\Entity\WeeklyOpeningHours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayOpeningHoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dayOfWeek', ChoiceType::class, [
                'choices' => [
                    'Monday' => 'Monday',
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    'Saturday' => 'Saturday',
                    'Sunday' => 'Sunday',
                ],
                'label' => false, // Customize labels as needed
            ])
            ->add('openingTime', TimeType::class, [
                'input' => 'string',
                'widget' => 'single_text',
                'label' => false, // Customize labels as needed
            ])
            ->add('closingTime', TimeType::class, [
                'input' => 'string',
                'widget' => 'single_text',
                'label' => false, // Customize labels as needed
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeeklyOpeningHours::class,
        ]);
    }
}
