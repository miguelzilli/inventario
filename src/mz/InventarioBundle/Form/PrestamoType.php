<?php

namespace mz\InventarioBundle\Form;

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
            ->add('dni', null, array('label'=>'DNI'))
            ->add('fecha', 'date', array('input'=>'datetime'))
            ->add('fechaDevolucion', 'date', array('label'=>'Fecha de Devolución', 'input'=>'datetime'))
            ->add('observaciones')
            ->add('item')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mz\InventarioBundle\Entity\Prestamo'
        ));
    }

    public function getName()
    {
        return 'mz_prestamotype';
    }
}
