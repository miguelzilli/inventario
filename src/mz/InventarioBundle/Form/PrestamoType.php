<?php

namespace mz\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrestamoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('apellido')
                ->add('nombre')
                ->add('dni', null, array('label' => 'DNI'))
                ->add('fecha', 'genemu_jquerydate', array(
                'widget' => 'single_text',
                'label'=>'Fecha', 
                'input'=>'datetime'
                ))
                ->add('fechaDevolucion', 'genemu_jquerydate', array(
                'widget' => 'single_text',
                'label'=>'Fecha de Devolución', 
                'input'=>'datetime'
                ))
                ->add('observaciones')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'mz\InventarioBundle\Entity\Prestamo'
        ));
    }

    public function getName() {
        return 'mz_inventariobundle_prestamotype';
    }

}
