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
    public function handleErrorView(Throwable $viewableException, int $httpCode, array $headers = []): View
    {
        return View::create([
            'error_type'    => 'api',
            'error_message' => $viewableException->getMessage()
        ], $httpCode, $headers);
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
            $form->addError(new FormError('No data in payload'));

            throw new InvalidFormException('form not submitted', 0, $form, null);
        }

        if (!$form->isValid()) {
            throw new InvalidFormException('form is invalid', 0, $form, null);
        }

        return $form;
    }
}