<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Route;
use AppBundle\Entity\Distrit;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;

class RouteConductorType extends AbstractType
{

    protected $em;

//    public function __construct(EntityManager $em) {
    public function __construct() {
//        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	
	    $hour = date('H');
	    $hourArray = range($hour, 23);
	    
	    $minute = date('i');
	    $minuteArray = range($minute, 59);
	
	    $builder

//            ->add('route', EntityType::class, [
//                'class' => Route::class,
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->findAllObjects();
//                },
//                'placeholder' => '[ Escoge una opción ]',
//                'empty_data' => null,
//                'required' => false,
//                'label' => 'Punto de venta padre',
//                'label_attr' => [
//                    'class' => ''
//                ],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => '',
//                ],
//            ])

            ->add('distritFrom', EntityType::class, [
                'class' => Distrit::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC')
                        ;
                },
                'placeholder' => false,
                'empty_data' => null,
                'required' => false,
                'label' => 'Desde',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('distritTo', EntityType::class, [
                'class' => Distrit::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC')
                        ;
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => true,
                'label' => 'Hasta',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('nroOfSeats', IntegerType::class, [
                'label' => 'Nro asientos',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '#',
                    'min' => '0',
                    'max' => '9',
                    'onkeydown' => 'limit(this);',
                    'onkeyup' => 'limit(this);',
                ],
            ])
            ->add('timeStart', TimeType::class, [
                'label' => 'Hora salida',
                'input'  => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'html5' => true,
                'hours' => $hourArray,
                'minutes' => $minuteArray,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'hora salida',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descripcion',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'dirección',
                ],
            ])
            ->add('latitudeStart', TextType::class, [
                'label' => 'latitude inicio',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0.00',
                    'onfocus' => 'blur()',
                ],
            ])
            ->add('longitudeStart', TextType::class, [
                'label' => 'longitude inicio',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0.00',
                    'onfocus' => 'blur()',
                ],
            ])
            ->add('latitudeEnd', TextType::class, [
                'label' => 'latitude fin',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0.00',
                    'onfocus' => 'blur()',
                ],
            ])
            ->add('longitudeEnd', TextType::class, [
                'label' => 'longitude fin',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0.00',
                    'onfocus' => 'blur()',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-danger btn-block btn-flat ',
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Route::class
        ]);
    }

}
