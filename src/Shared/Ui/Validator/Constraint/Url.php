<?php
declare(strict_types=1);

namespace App\Shared\Ui\Validator\Constraint;

use App\Shared\Ui\Validator\Validator\UrlValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Url extends Constraint
{
    public $message = 'The string "{{ value }}" should be a valid url like http://example.com';

    public function validatedBy()
    {
        return UrlValidator::class;
    }
}