<?php

namespace App\Form;

use App\Entity\GoodOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddToCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('price')
            ->add('amount')
            ->add('add', SubmitType::class, [
                'label' => 'Add to cart'
            ]);
//            ->add('idgood')
//            ->add('idorder')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GoodOrder::class,
        ]);
    }
}
