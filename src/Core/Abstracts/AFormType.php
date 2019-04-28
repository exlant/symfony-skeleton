<?php
declare(strict_types=1);

namespace App\Core\Abstracts;

use App\Core\Form\PaginateType;
use App\Core\Traits\Aware\TEntityManagerAware;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AFormType
 *
 * @package App\Core\Abstracts
 */
abstract class AFormType extends AbstractType
{
    use TEntityManagerAware;

    public const FILTER = 'filter';
    public const ORDER = 'order';
    public const PAGINATION = 'pagination';

    /**
     * @param FormEvent $event
     * @param string $field
     * @param string $class
     * @param string $message
     *
     * @return bool
     */
    public function isValueExistInDB(FormEvent $event, string $field, string $class, string $message = null): bool
    {
        $value = $event->getData()[$field];
        $form = $event->getForm();
        $userRepo = $this->getEm()->getRepository($class);
        $isExist = (bool)$userRepo->findOneBy([$field => $value]);
        if (!$isExist && null !== $message) {
            $form->get($field)->addError(new FormError($message));
        }

        return $isExist;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
        ));
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    protected function addFilterOrderPagination(FormBuilderInterface $builder): FormBuilderInterface
    {
        $filterForm = $builder->create(static::FILTER, FormType::class, [
            'by_reference' => true,
        ]);

        $orderForm = $builder->create(static::ORDER, FormType::class, [
            'by_reference' => true,
        ]);

        return $builder
            ->add($this->addFilter($filterForm))
            ->add($this->addOrder($orderForm))
            ->add(static::PAGINATION, PaginateType::class, [
                'by_reference' => true,
            ])
        ;
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    protected function addFilter(FormBuilderInterface $builder): FormBuilderInterface
    {
        return $builder;
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    protected function addOrder(FormBuilderInterface $builder): FormBuilderInterface
    {
        return $builder;
    }
}