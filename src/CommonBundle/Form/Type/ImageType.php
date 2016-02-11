<?php

namespace RP\CommonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $view->vars['image_filter'] = $options['image_filter'];
        $view->vars['image_path'] = $propertyAccessor->getValue($form->getRoot()->getData(), $options['image_property_path']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['image_filter', 'image_property_path']);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'file';
    }

    public function getBlockPrefix()
    {
        return 'rp_image';
    }


    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
