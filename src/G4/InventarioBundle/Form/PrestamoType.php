<?php

namespace G4\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrestamoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('fecha')
            ->add('fechaDevolucion')
            ->add('observaciones')
            ->add('createdAt')
            ->add('createdBy')
            ->add('updatedAt')
            ->add('updatedBy')
            ->add('item')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'G4\InventarioBundle\Entity\Prestamo'
        ));
    }

    public function getName()
    {
        return 'g4_inventariobundle_prestamotype';
    }
}
