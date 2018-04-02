<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\User;
use AppBundle\Entity\Profile;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class UpdateProfileType extends AbstractType
{

    protected $em;

    public function __construct() {

    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('profile', EntityType::class, array(
                'class' => Profile::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->where('a.isActive = :active')
                        ->andWhere('a.idIncrement IN (2,3)')
                        ->orderBy('a.idIncrement', 'DESC')
                        ->setParameter('active', true)
                        ;
//                        ->add('orderBy', 's.sort_order ASC')
//                        ->innerJoin('a.languages', 'b')
//                        ->addSelect('b')
                },
                'placeholder' => false,
//                'empty_data' => null,
                'required' => false,
                'label' => 'Escoja una opción:',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ))
            ->add('submit', SubmitType::class, [
                'label' => 'Ingresar',
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
            'data_class' => User::class
        ]);
    }

}
