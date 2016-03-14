<?php

namespace RP\CommonBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class SortablePositionTransformer implements DataTransformerInterface
{
    public function transform($zeroBaseValue)
    {
        return (int) $zeroBaseValue + 1;
    }

    public function reverseTransform($oneBaseValue)
    {
        return (int) $oneBaseValue - 1;
    }
}
