<?php
declare(strict_types=1);

namespace App\Shared\Exception;

use Symfony\Component\Form\FormInterface;

class InvalidFormException extends InvalidArgumentException
{
    /**
     * @var FormInterface
     */
    private $form;

    public function __construct($message, $code, FormInterface $form, $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->form = $form;
    }

    /**
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        return $this->form;
    }
}