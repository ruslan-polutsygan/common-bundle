<?php

namespace RP\CommonBundle\Form\Type;

use RP\CommonBundle\Form\DataTransformer\SortablePositionTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new SortablePositionTransformer());
    }

    public function getBlockPrefix()
    {
        return 'app_position';
    }

    public function getParent()
    {
        return 'text';
    }
}
