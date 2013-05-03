<?php

namespace mz\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use mz\InventarioBundle\Entity\Usuario as Usuario;

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
            //->add('salt')
            ->add('roles', 'choice', array(
                'label' => 'Rol',
                'choices' => Usuario::obtenerRoles()))
             ->add('isEnabled', null, array('label'=>'Habilitado?'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mz\InventarioBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'mz_inventariobundle_usuariotype';
    }
}
