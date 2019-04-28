<?php
declare(strict_types=1);

namespace App\Form;

use App\Core\Abstracts\AFormType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class SearchType
 *
 * @package App\Form
 */
class SearchFlightType extends AFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addFilterOrderPagination($builder);
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    public function addFilter(FormBuilderInterface $builder): FormBuilderInterface
    {
        return $builder
            ->add('departureAirport', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('arrivalAirport', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('departureDate', DateTimeType::class, [
                'format' => 'yyyy-MM-dd hh:mm',
                'widget' => 'single_text',
                'constraints' => [

                ],
            ]);
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    public function addOrder(FormBuilderInterface $builder): FormBuilderInterface
    {
        return $builder->add('arrivalDateTime', TextType::class, [

            ]);
    }
}