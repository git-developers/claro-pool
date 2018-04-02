<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Route;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;

class RouteType extends AbstractType
{

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('route', EntityType::class, [
                'class' => Route::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'Punto de venta padre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('image', TextType::class, [
                'label' => 'image',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'http://www.phostersoft.com/images/phostersoft/gazelle/gazelleicon175.png',
                ],
            ])
            ->add('code', TextType::class, [
                'label' => 'code',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('precioPorHora', IntegerType::class, [
                'label' => 'Precio por hora',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Precio por hora',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Dirección',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'dirección',
                ],
            ])
            ->add('telephone', IntegerType::class, [
                'label' => 'telephone',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'telephone',
                ],
            ])
            ->add('latitudeStart', TextType::class, [
                'label' => 'latitude inicio',
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
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'longitude fin',
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
