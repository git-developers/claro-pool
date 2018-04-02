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
                ],
            ])
            ->add('timeStart', TimeType::class, [
                'label' => 'Hora salida',
                'input'  => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'html5' => true,
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
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'latitude inicio',
                ],
            ])
            ->add('longitudeStart', TextType::class, [
                'label' => 'longitude inicio',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'longitude inicio',
                ],
            ])
            ->add('latitudeEnd', TextType::class, [
                'label' => 'latitude fin',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'latitude fin',
                ],
            ])
            ->add('longitudeEnd', TextType::class, [
                'label' => 'longitude fin',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'longitude fin',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Registrar',
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
