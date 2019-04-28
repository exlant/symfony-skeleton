<?php
declare(strict_types=1);

namespace App\Core\Form;

use App\Core\Abstracts\AFormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;

/**
 * Class PaginateType
 *
 * @package App\Core\Form
 */
class PaginateType extends AFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page', IntegerType::class, [
                'empty_data' => 1,
            ])
            ->add('limit', IntegerType::class, [
                'empty_data' => getenv('PAGE_DEFAULT_LIMIT'),
                'constraints' => [
                    new Range([
                        'min' => 1,
                        'minMessage' => 'page.limit.min',
                        'max' => getenv('PAGE_MAX_LIMIT'),
                        'maxMessage' => 'page.limit.max',
                    ])
                ]
            ]);
    }
}