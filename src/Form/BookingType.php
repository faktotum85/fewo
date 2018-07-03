<?php


namespace App\Form;


use App\Data\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'booking.field.firstName'
            ])
            ->add('lastName',TextType::class, [
                'label' => 'booking.field.lastName'
            ])
            ->add('street', TextType::class, [
                'label' => 'booking.field.street'
            ])
            ->add('streetNumber', TextType::class, [
                'label' => 'booking.field.streetNumber'
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'booking.field.zipcode'
            ])
            ->add('city', TextType::class, [
                'label' => 'booking.field.city'
            ])
            ->add('arrivalDate', DateType::class, [
                'label' => 'booking.field.arrivalDate'
            ])
            ->add('departureDate', DateType::class, [
                'label' => 'booking.field.departureDate'
            ])
            ->add('email', EmailType::class, [
                'label' => 'booking.field.email'
            ])
            ->add('phone', TextType::class, [
                'label' => 'booking.field.phone'
            ])
            ->add('comments', TextareaType::class, [
                'label' => 'booking.field.comments'
            ])
            ->add('agreedToTerms', CheckboxType::class, [
                'label' => false
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class
        ]);
    }
}