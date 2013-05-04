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
            ->add('sn')
            ->add('fechaCompra')
            ->add('costo')
            ->add('garantia')
            ->add('descripcion')
            ->add('codigo')
            ->add('createdAt')
            ->add('createdBy')
            ->add('updatedAt')
            ->add('updatedBy')
            ->add('categoria')
            ->add('condicion')
            ->add('estado')
            ->add('ubicacion')
        ;
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
