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
use AppBundle\Entity\PasajeroHasRoute;
use AppBundle\Entity\Distrit;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;

class PasajeroHasRouteType extends AbstractType
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
            ->add('nroOfSeats', IntegerType::class, [
                'label' => 'Nro asientos',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '#',
                    'min' => '1',
                    'max' => '100',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Solicitar',
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
            'data_class' => PasajeroHasRoute::class
        ]);
    }

}
