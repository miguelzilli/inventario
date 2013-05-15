<?php

namespace mz\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use mz\InventarioBundle\Entity\Item as Item;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('marca')
            ->add('modelo')
            ->add('categoria', null, array('label'=>'Categoría'))
            ->add('sn', null, array('label'=>'SerialNumber'))
            ->add('fechaCompra', 'genemu_jquerydate', array(
                'widget' => 'single_text',
                'label'=>'Fecha de Compra', 
                'input'=>'datetime'
                ))
            ->add('costo', 'money', array('currency'=>false))
            ->add('garantia', 'choice', array('label'=>'Garantía', 'choices'=>Item::obtenerGarantias()))
            ->add('descripcion', null, array('label'=>'Descripción'))
            ->add('codigo', null, array('label'=>'Código'))
            ->add('condicion', null, array('label'=>'Condición'))
            ->add('estado')
            ->add('ubicacion', null, array('label'=>'Ubicación'))
            ->add('imagenes','collection', array(
                'label' => 'Imágenes',
                'type'         => new ImagenType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mz\InventarioBundle\Entity\Item'
            ));
    }

    public function getName()
    {
        return 'mz_itemtype';
    }
}
