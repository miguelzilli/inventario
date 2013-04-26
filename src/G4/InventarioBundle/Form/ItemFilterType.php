<?php

namespace G4\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class ItemFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('nombre', 'filter_text')
            ->add('marca', 'filter_text')
            ->add('modelo', 'filter_text')
            ->add('sn', 'filter_text')
            ->add('fechaCompra', 'filter_date_range')
            ->add('costo', 'filter_number_range')
            ->add('garantia', 'filter_number_range')
            ->add('descripcion', 'filter_text')
            ->add('codigo', 'filter_text')
            ->add('createdAt', 'filter_date_range')
            ->add('createdBy', 'filter_text')
            ->add('updatedAt', 'filter_date_range')
            ->add('updatedBy', 'filter_text')
        ;

        $listener = function(FormEvent $event)
        {
            // Is data empty?
            foreach ($event->getData() as $data) {
                if(is_array($data)) {
                    foreach ($data as $subData) {
                        if(!empty($subData)) return;
                    }
                }
                else {
                    if(!empty($data)) return;
                }
            }

            $event->getForm()->addError(new FormError('Filter empty'));
        };
        $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function getName()
    {
        return 'g4_inventariobundle_itemfiltertype';
    }
}