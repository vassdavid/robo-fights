<?php

namespace App\Form;

use App\Entity\Robot;
use App\Enum\Entity\RobotTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RobotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('type', ChoiceType::class, [
                'choices' => RobotTypes::cases(),
                'choice_label' => function(RobotTypes $type) {
                    return $type->value;
                },
                'choice_value' => function (?RobotTypes $type) {
                    return $type?->value;
                },
                'required' => true,
            ])
            ->add('power', IntegerType::class)
            ->add('imageUrl', UrlType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Robot::class,
        ]);
    }
}
