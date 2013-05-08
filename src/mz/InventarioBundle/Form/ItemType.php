<?php

namespace mz\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('marca')
            ->add('modelo')
            ->add('categoria')
            ->add('sn')
            ->add('fechaCompra')
            ->add('costo')
            ->add('garantia')
            ->add('descripcion')
            ->add('codigo')
            ->add('condicion')
            ->add('estado')
            ->add('ubicacion')
            ->add('imagenes','collection', array(
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
