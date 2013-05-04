<?php

namespace mz\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use mz\InventarioBundle\Entity\Usuario as Usuario;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;

class UsuarioChangePassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $userpass=new UserPassword();
        $userpass->message='Contraseña incorrecta.';
        $builder
            ->add('currentPass', 'password', array(
                'mapped' => false,
                'label' => 'Password actual',
                'constraints' => array($userpass),
                ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las contraseñas no coinciden.',
                'required' => true,
                'first_options'  => array('label' => 'Nuevo Password'),
                'second_options' => array('label' => 'Repetir Password'),
                ))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mz\InventarioBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'mz_usuariotype';
    }
}
