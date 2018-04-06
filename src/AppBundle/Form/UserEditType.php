<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                'label' =>' Nombre',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'nombre',
                ],
                'error_bubbling' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'example@tianos.com',
                ],
                'error_bubbling' => true
            ])
            ->add('code', TextType::class, [
                'label' => 'Codigo',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'C12345',
                    'maxlength'=>'5',
                    'minlength'=>'5',
//                    'form'=>'user-form',
                ],
                'error_bubbling' => true
            ])
            ->add('phone', IntegerType::class, [
                'label' => 'Telefono',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'ingrese el telefono del usuario',
                ],
                'error_bubbling' => true
            ])
//            ->add('password', PasswordType::class, [
//                'label' => 'Password',
//                'required' => false,
//                'label_attr' => ['class' => 'control-label'],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => '******',
//                ],
//                'error_bubbling' => true
//            ])
            ->add('isAuto', CheckboxType::class, [
                'label' =>'Tiene auto',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => '',
                    'placeholder' => '',
                ],
            ])
            ->add('color', ChoiceType::class, [
                'label' =>' Color',
                'required' => false,
                'choices'  => [
                    'Azul' => 'Azul',
                    'Rojo' => 'Rojo',
                    'Blanco' => 'Blanco',
                    'Negro' => 'Negro',
                ],
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'color',
                ],
            ])
            ->add('model', TextType::class, [
                'label' =>' Model',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'model',
                ],
            ])
            ->add('plate', TextType::class, [
                'label' =>' Plate',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'plate',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Registrar',
                'attr' => [
                    'class' => 'btn bg-yellow btn-block btn-flat',
                ],
            ])
        ;

        /*
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();
        });
        */
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
//        $resolver->setRequired('entity_manager');
    }

}
