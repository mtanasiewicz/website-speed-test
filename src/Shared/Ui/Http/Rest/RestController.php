<?php
declare(strict_types=1);

namespace App\Shared\Ui\Http\Rest;

use App\Shared\Exception\InvalidFormException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

abstract class RestController extends AbstractFOSRestController
{
    private const INVALID_PAYLOAD_MESSAGE = 'No data in payload';

    public function handleErrorView(Throwable $viewableException, int $httpCode, array $headers = []): Response
    {
        $view = View::create([
            'error_type'    => 'api',
            'error_message' => $viewableException->getMessage()
        ], $httpCode, $headers);

        $handler = $this->getViewHandler();

        return $handler->handle($view);
    }

    public function handleView(View $view): Response
    {
        $handler = $this->getViewHandler();

        return $handler->handle($view);
    }

    public function handleForm(Request $request, string $type, $data = null, array $options = []): FormInterface
    {
        $form = parent::createForm($type, $data, $options);

        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            if(!$request->isMethod('GET')) {
                $body = $request->getContent();
                $data = json_decode($body, true);

                $form->submit($data);
            } else {
                $form->addError(new FormError(self::INVALID_PAYLOAD_MESSAGE));

                throw new InvalidFormException(self::INVALID_PAYLOAD_MESSAGE, 0, $form, null);
            }
        }

        if (!$form->isValid()) {
            $message = $this->extractFormErrorMessage($form);

            throw new InvalidFormException($message, 0, $form, null);
        }

        return $form;
    }

    /**
     * @param FormInterface $form
     * @return string
     */
    private function extractFormErrorMessage(FormInterface $form): string
    {
        return (string) $form->getErrors(true, false);
    }
}