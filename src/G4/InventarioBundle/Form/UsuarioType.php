<?php

namespace G4\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellido')
            ->add('nombre')
            ->add('email')
            ->add('username')
            ->add('password')
            ->add('isEnabled')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'G4\InventarioBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'g4_inventariobundle_usuariotype';
    }
}
