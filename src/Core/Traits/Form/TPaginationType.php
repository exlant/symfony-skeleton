<?php
declare(strict_types=1);

namespace App\Core\Traits\Form;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;

/**
 * Trait Pagination
 *
 * @package
 */
trait TPaginationType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $groups
     *
     * @return FormBuilderInterface
     */
    protected function addPagination(FormBuilderInterface $builder, array $groups = []): FormBuilderInterface
    {
        return $builder->add($builder->create('pagination', FormType::class, [
            'by_reference' => false,
            'allow_extra_fields' => true,
        ])
            ->add('page', IntegerType::class, [
                'empty_data' => 1,
                
            ])
            ->add('limit', IntegerType::class, [
                'empty_data' => getenv('PAGE_DEFAULT_LIMIT'),
                'constraints' => [
                    new Range([
                        'groups' => $groups,
                        'min' => 1,
                        'minMessage' => 'page.limit.min',
                        'max' => getenv('PAGE_MAX_LIMIT'),
                        'maxMessage' => 'page.limit.max',
                    ])
                ]
            ])
        );
    }
}