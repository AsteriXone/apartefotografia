<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label'=>"Nombre"))
            ->add('email', EmailType::class, array('label'=>"Correo"))
            ->add('ape_1', null, array('label'=>"Apellido 1"))
            ->add('ape_2', null, array('required' => false, 'label'=>"Apellido 2"))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Confirme Contraseña'),
            ))
            ->add('direccion', null, array('label'=>"Dirección"))
            ->add('telefono', null, array('label'=>"Teléfono"))
            ->add('titulacion', null, array('required' => false))
            ->add('mencion', null, array('required' => false))
            ->add('codigoGrupo', TextType::class, array('label'=>"Código de Grupo",'mapped' => false))
            ->add('save', SubmitType::class, array('label' => 'Registrar'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
