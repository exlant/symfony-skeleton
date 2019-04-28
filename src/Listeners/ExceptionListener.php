<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Core\Exception\ENullArgument;
use App\Core\Exception\IFormWrongRequest;
use App\Core\Traits\Aware\TConverterAware;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Class ExceptionListener
 *
 * @package App\Listeners
 */
final class ExceptionListener
{
    use TConverterAware;

    /** @var ViewHandlerInterface */
    private $viewHandler;
    
    /**
     * Get the ViewHandler.
     * @required
     *
     * @param ViewHandlerInterface $viewHandler
     */
    public function setViewHandler(ViewHandlerInterface $viewHandler): void
    {
        $this->viewHandler = $viewHandler;
    }

    /**
     * @return Response
     */
    private function createResponse(): Response
    {
        return new Response();
    }

    /**
     * @param GetResponseForExceptionEvent $event
     * @throws ENullArgument
     */
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();
        $this->handleException($exception, $event);
    }

    /**
     * @param \Exception $exception
     * @param GetResponseForExceptionEvent $event
     * @throws ENullArgument
     */
    private function handleException(\Exception $exception, GetResponseForExceptionEvent $event): void
    {
        if ($exception instanceof IFormWrongRequest) {
            $response = $this->parseFormError($exception);
        } else {
            $response = $this->parseException($exception);
        }

        $event->setResponse($response);
    }

    /**
     * @param IFormWrongRequest $exception
     *
     * @return Response
     * @throws ENullArgument
     */
    private function parseFormError(IFormWrongRequest $exception): Response
    {
        $formErrors = $exception->getForm()->getErrors(true, false);
        $content = $this->getConverter()->parseFormErrors($formErrors);
        $response = $this->createResponse()
            ->setContent($content)
            ->setStatusCode($exception->getStatus());

        return $response;
    }

    /**
     * @param \Exception $exception
     *
     * @return Response
     * @throws ENullArgument
     */
    private function parseException(\Exception $exception): Response
    {
        $content = $this->getConverter()->parseException($exception);
        $response = $this->createResponse()
            ->setContent($content)
            ->setStatusCode(Response::HTTP_BAD_REQUEST);

        return $response;
    }
}
