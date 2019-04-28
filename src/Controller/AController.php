<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Abstracts\ARepository;
use App\Core\Exception\EFormWrongRequest;
use App\Core\Exception\ExceptionFactory;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AController
 *
 * @package App\Controller
 */
class AController extends AbstractFOSRestController
{
    /**
     * @param $data
     * @param array|string|null $groups
     * @param array $headers
     * @param int $statusCode
     *
     * @return Response
     */
    public function response($data, $groups = null, array $headers = [], int $statusCode = 200): Response
    {
        if (\is_string($groups)) {
            $groups = [$groups];
        }
        $view = $this->view($data, $statusCode, $headers);
        
        if($groups && \count($groups)){
            $context = new Context();
            $context->setGroups($groups);
            $view->setContext($context);
        }
        
        return $this->handleView($view);
    }

    /**
     * @param string $formClass
     * @param array $data
     * @param array $groups
     *
     * @return Form
     * @throws EFormWrongRequest
     */
    protected function validateFilterRequest(string $formClass, array $data, array $groups = []): Form
    {
        /** @var Form $form */
        $form = $this->createForm($formClass);
        $form->submit($data);
        if (!$form->isValid()) {
            throw ExceptionFactory::wrongRequestData($form, Response::HTTP_ALREADY_REPORTED, $groups);
        }
    
        return $form;
    }
    
    /**
     * @param $request
     * @param ARepository $repository
     *
     * @return array
     * @throws \Exception
     */
    protected function getCollectionByFilters($request, ARepository $repository): array
    {
        var_dump($request); die;
        $filters = $request['filters'];
        $order = $request['order'];
        $pagination = $request['TPaginationType'];
        
        $pager = $repository->filterBy($filters, $order, $pagination);
        
        return [
            'items' => $pager->getItems(),
            'TPaginationType' => [
                'page' => $pager->getCurrentPageNumber(),
                'totalPages' => 1 + (int)($pager->getTotalItemCount() / $pager->getItemNumberPerPage()),
                'totalItems' => $pager->getTotalItemCount(),
                'limit' => $pager->getItemNumberPerPage(),
                'count' => \count($pager->getItems()),
            ]
        ];
    }
}